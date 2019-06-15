<template>
  <span>
    <router-link v-for="item in menu" :key="item.id" :to="{name:''+item.name+''}">
      <v-list-tile>
        <v-list-tile-action>
          <v-icon>dashboard</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>{{item.desc}}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
    </router-link>
  </span>
</template>
<script>
export default {
  data() {
    return {
      menu: [
        { name: "adminHome", desc: "Dashboard" },
        { name: "adminSubscribes", desc: "Sbubscriber" },
        { name: "adminPosts", desc: "Posts" },
        { name: "adminCategory", desc: "Categories" },
        { name: "adminComments", desc: "Comments" },
        { name: "adminGallery", desc: "Galleries" },
        { name: "adminMessages", desc: "Messages" },
        { name: "adminNavigationGroups", desc: "NavigationGroups" },
        { name: "adminNavigations", desc: "Navigation" },
        { name: "adminSettings", desc: "Settings" },
        { name: "adminUsers", desc: "Users" },
        { name: "adminStatus", desc: "Status" }
      ]
    };
  },

  created() {}
};
</script>

