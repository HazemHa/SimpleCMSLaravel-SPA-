<template>
  <v-app id="inspire" dark>
    <v-navigation-drawer v-model="drawer" clipped fixed app>
      <v-list dense>
        <menu-admin></menu-admin>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar app fixed clipped-left>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>Application</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn color="error" v-if="$store.getters['users/isAuth']" @click="logout">Logout</v-btn>
    </v-toolbar>
    <v-content>
      <v-container fluid fill-height>
        <v-layout justify-center align-center>
          <v-flex shrink>
            <router-view></router-view>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
    <v-footer app fixed>
      <span>&copy; 2017</span>
    </v-footer>
  </v-app>
</template>

<script>
import menuAdmin from "./menu.vue";
export default {
  components: {
    "menu-admin": menuAdmin
  },
  created() {
    const self = this;
    setTimeout(function() {
      self.$store
        .dispatch("users/setTokenForRequest")
        .then(function(value) {
          if (value) {
            self.$nextTick();
          } else {
            self.$nextTick();
          }
        })
        .catch(err => {});
    }, 1000);
  },
  data: () => ({
    drawer: null
  }),
  props: {
    source: String
  },
  methods: {
    logout() {
      this.$store
        .dispatch("users/logout")
        .then(res => {
          if (!res.data.auth) {
            this.$toaster.success("logout sucessfull");
            this.$router.push("/");
            window.location.reload();
            this.$nextTick();
          }
        })
        .catch(err => {
          this.$toaster.error(err);
        });
    }
  }
};
</script>
