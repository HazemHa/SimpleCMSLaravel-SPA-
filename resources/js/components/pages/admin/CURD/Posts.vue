<template>
  <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>Posts</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on }">
          <v-btn color="primary" dark class="mb-2" v-on="on">New Posts</v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.user_id" label="user"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.title" label="title"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.content" label="content"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.category_id" label="category"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.image" label="image"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.status_id" label="status"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.click" label="click"></v-text-field>
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
        <td class="text-xs-right">{{ props.item.user.name}}</td>
        <td class="text-xs-right">{{ props.item.title}}</td>
        <td class="text-xs-right">{{ props.item.content}}</td>
        <td class="text-xs-right">{{ props.item.category.name}}</td>
        <td class="text-xs-right">{{ props.item.image}}</td>
        <td class="text-xs-right">{{ props.item.status.name}}</td>
        <td class="text-xs-right">{{ props.item.click}}</td>
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
        text: "user",
        value: "user"
      },
      {
        text: "title",
        value: "title"
      },
      {
        text: "content",
        value: "content"
      },
      {
        text: "category",
        value: "category"
      },
      {
        text: "image",
        value: "image"
      },
      {
        text: "status_",
        value: "status"
      },
      {
        text: "click",
        value: "click"
      },
      { text: "Actions", value: "name", sortable: false }
    ],
    data: [],
    editedIndex: -1,
    editedItem: {
      user_id: "",
      title: "",
      content: "",
      category_id: "",
      image: "",
      status_id: "",
      click: ""
    },
    defaultItem: {
      user_id: "",
      title: "",
      content: "",
      category_id: "",
      image: "",
      status_id: "",
      click: ""
    }
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Posts" : "Edit Posts";
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
        .dispatch("posts/getPosts")
        .then((res) => {
          this.data = res.Posts;
        })
        .catch((err) => {
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
          .dispatch("posts/deletePosts", { id: item.id })
          .then((res) => {
            if (res.mutationPosts.id == -1) {
              console.log("cant delete ");
            } else {
              this.data.splice(index, 1);
            }
          })
          .catch((err) => {
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
          .dispatch("posts/updatePosts", this.editedItem)
          .then((res) => {
            if (res.mutationPosts.id == -1) {
              console.log("cant update ");
            } else {
              Object.assign(this.data[this.editedIndex], res.mutationPosts);
            }
          })
          .catch((err) => {
            console.log(err);
          });
      } else {
        // create record
        console.log(this.editedItem);
        this.$store
          .dispatch("posts/createPosts", this.editedItem)
          .then((res) => {
            this.data.push(res.mutationPosts);
          })
          .catch((err) => {
            console.log(err);
          });
      }

      this.close();
    }
  }
};
</script>
