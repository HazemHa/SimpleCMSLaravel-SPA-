<template>
  <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>Navigations</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on }">
          <v-btn color="primary" dark class="mb-2" v-on="on">New Navigations</v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.link_text" label="link_text"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.url" label="url"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.description" label="description"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.group_id" label="Group"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.click_count" label="click_count"></v-text-field>
                </v-flex>
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
    <v-data-table :headers="headers" :items="data" class="elevation-1">
      <template v-slot:items="props">
        <td class="text-xs-right">{{ props.item.link_text}}</td>
        <td class="text-xs-right">{{ props.item.url}}</td>
        <td class="text-xs-right">{{ props.item.description}}</td>
        <td class="text-xs-right">{{ props.item.groupNavigation.id}}</td>
        <td class="text-xs-right">{{ props.item.click_count}}</td>
        <td class="justify-center layout px-0">
          <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
          <v-icon small @click="deleteItem(props.item)">delete</v-icon>
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
        text: "link_text",
        value: "link_text"
      },
      {
        text: "url",
        value: "url"
      },
      {
        text: "description",
        value: "description"
      },
      {
        text: "Group",
        value: "Group"
      },
      {
        text: "click_count",
        value: "click_count"
      },
      { text: "Actions", value: "name", sortable: false }
    ],
    data: [],
    editedIndex: -1,
    editedItem: {
      link_text: "",
      url: "",
      description: "",
      group_id: "",
      click_count: ""
    },
    defaultItem: {
      link_text: "",
      url: "",
      description: "",
      group_id: "",
      click_count: ""
    }
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Navigations" : "Edit Navigations";
    }
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  created() {
    this.initialize();
  },
  methods: {
    initialize() {
      this.data = [];
      this.$store
        .dispatch("navigations/getNavigations")
        .then(res => {
          this.data = res.Navigations;
        })
        .catch(err => {
          console.log(err);
        });
    },
    editItem(item) {
      this.editedIndex = this.data.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    deleteItem(item) {
      const index = this.data.indexOf(item);
      if (confirm("Are you sure you want to delete this item?")) {
        this.$store
          .dispatch("navigations/deleteNavigations", { id: item.id })
          .then(res => {
            if (res.mutationNavigations.id == -1) {
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
    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },
    save() {
      if (this.editedIndex > -1) {
        // update the record
        this.$store
          .dispatch("navigations/updateNavigations", this.editedItem)
          .then(res => {
            if (res.mutationNavigations.id == -1) {
              console.log("cant update ");
            } else {
              Object.assign(
                this.data[this.editedIndex],
                res.mutationNavigations
              );
            }
          })
          .catch(err => {
            console.log(err);
          });
      } else {
        // create record
        console.log(this.editedItem);
        this.$store
          .dispatch("navigations/createNavigations", this.editedItem)
          .then(res => {
            this.data.push(res.mutationNavigations);
          })
          .catch(err => {
            console.log(err);
          });
      }

      this.close();
    }
  }
};
</script>
