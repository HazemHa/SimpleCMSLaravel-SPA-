<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-form>
        <v-text-field prepend-icon="person" name="email" label="email" v-model="email" type="text"></v-text-field>
        <v-text-field
          id="password"
          prepend-icon="lock"
          name="password"
          v-model="password"
          label="Password"
          type="password"
        ></v-text-field>
      </v-form>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="green darken-3" @click="login">Login</v-btn>
      </v-card-actions>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    drawer: null,
    email: "",
    password: ""
  }),
  created() {},

  props: {
    source: String
  },
  methods: {
    login() {
      this.$store
        .dispatch("users/singin", {
          email: this.email,
          password: this.password
        })
        .then(res => {
          if (res.data.auth) {
            this.$toaster.success("sing in sucessfull");
            if (res.data.user.role_id == 5) {
              this.$router.push({ name: "adminHome" });
              window.location.reload()
            } else {
              this.$router.push({ name: "home" });
            }
          } else {
            this.$toaster.error(
              "error in credentials check from your pass and email"
            );
          }
          //  this.$store.dispatch("checkRole");
          //  this.$router.push("/");
        })
        .catch(err => this.$toaster.error(err));
    }
  }
};
</script>
