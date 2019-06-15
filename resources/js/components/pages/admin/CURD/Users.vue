<template>
  <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>Users</v-toolbar-title>
      <v-divider
        class="mx-2"
        inset
        vertical
      ></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on }">
          <v-btn color="primary" dark class="mb-2" v-on="on">New Users</v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>

                  <v-flex xs12 sm6 md4><v-text-field v-model="editedItem.name" label="name"></v-text-field></v-flex>
<v-flex xs12 sm6 md4><v-text-field v-model="editedItem.email" label="email"></v-text-field></v-flex>
<v-flex xs12 sm6 md4><v-text-field v-model="editedItem.image" label="image"></v-text-field></v-flex>
<v-flex xs12 sm6 md4><v-text-field v-model="editedItem.email_verified_at" label="email_verified_at"></v-text-field></v-flex>
<v-flex xs12 sm6 md4><v-text-field v-model="editedItem.about" label="about"></v-text-field></v-flex>
<v-flex xs12 sm6 md4><v-text-field v-model="editedItem.password" label="password"></v-text-field></v-flex>


              </v-layout>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
            <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="data"
      class="elevation-1"
    >
      <template v-slot:items="props">
<td class="text-xs-right">{{ props.item.name}} </td>
<td class="text-xs-right">{{ props.item.email}} </td>
<td class="text-xs-right">{{ props.item.image}} </td>
<td class="text-xs-right">{{ props.item.email_verified_at}} </td>
<td class="text-xs-right">{{ props.item.about}} </td>
<td class="text-xs-right">{{ props.item.password}} </td>
        <td class="justify-center layout px-0">
          <v-icon
            small
            class="mr-2"
            @click="editItem(props.item)"
          >
            edit
          </v-icon>
          <v-icon
            small
            @click="deleteItem(props.item)"
          >
            delete
          </v-icon>
        </td>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>
    </v-data-table>
  </div>
</template>
<script>
  export default {
    data: () => ({
      dialog: false,
      headers: [
{
          text: 'name',
          value: 'name'},
{
          text: 'email',
          value: 'email'},
{
          text: 'image',
          value: 'image'},
{
          text: 'email_verified_at',
          value: 'email_verified_at'},
{
          text: 'about',
          value: 'about'},
{
          text: 'password',
          value: 'password'}
,
        { text: 'Actions', value: 'name', sortable: false }
      ],
      data: [],
      editedIndex: -1,
      editedItem: {
 name: '',
 email: '',
 image: '',
 email_verified_at: '',
 about: '',
 password: ''
      },
      defaultItem: {
 name: '',
 email: '',
 image: '',
 email_verified_at: '',
 about: '',
 password: ''
      }
    }),
    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Users' : 'Edit Users'
      }
    },
    watch: {
      dialog (val) {
        val || this.close()
      }
    },
    created () {
      this.initialize()
    },
    methods: {
      initialize () {
        this.data = []
this.$store
        .dispatch("users/getUsers")
        .then((res) => {
          this.data = res.Users;
        })
        .catch(err => {
          console.log(err);
        });
      },
      editItem (item) {
        this.editedIndex = this.data.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },
      deleteItem (item) {
        const index = this.data.indexOf(item)
if (confirm("Are you sure you want to delete this item?")) {
        this.$store
          .dispatch("users/deleteUsers", { id: item.id })
          .then((res) => {

            if (res.mutationUsers.id == -1) {
              console.log("cant delete ");
            } else {
              this.data.splice(index, 1);
            }
          })
          .catch(err => {
            console.log(err);
          });
      }
      },
      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },
      save () {
if (this.editedIndex > -1) {
        // update the record
        this.$store
          .dispatch("users/updateUsers", this.editedItem)
          .then((res) => {
            if (res.mutationUsers.id == -1) {
              console.log("cant update ");
            } else {
              Object.assign(this.data[this.editedIndex], res.mutationUsers);
            }
          })
          .catch(err => {
            console.log(err);
          });
      } else {
        // create record
        console.log(this.editedItem);
        this.$store          .dispatch("users/createUsers", this.editedItem)
          .then((res) => {
            this.data.push(res.mutationUsers);
          })
          .catch(err => {
            console.log(err);
          });
      }

this.close()
      }
    }
  }
</script>
