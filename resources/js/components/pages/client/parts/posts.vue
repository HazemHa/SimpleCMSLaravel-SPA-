<template>
  <div class="single-recent-blog-post">
    <div class="col-lg-8">
      <div v-for="post in posts" :key="post.id">
        <div class="thumb">
          <router-link :to="{ name: 'post-details', params: { id: post.id }}">
            <img class="img-fluid" :src="post.image" alt>
          </router-link>
          <ul class="thumb-info">
            <li>
              <a href="#">
                <i class="ti-user"></i>
                {{post.user.name}}
              </a>
            </li>
            <li>
              <a href="#">
                <i class="ti-notepad"></i>
                <p>
                  <timeago :datetime="post.created_at"></timeago>
                </p>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="ti-themify-favicon"></i>
                {{post.comments.length}} Comments
              </a>
            </li>
          </ul>
        </div>
        <div class="details mt-20">
            <!-- public  --->
          <a href="#">
            <h3>{{ post.title }} ({{ post.category.name }})</h3>
          </a>

          <p>{{post.content}}</p>
          <a class="button" href="#">
            <router-link :to="{ name: 'post-details', params: { id: post.id }}">Read More</router-link>
            <i class="ti-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
    <side-bar></side-bar>
  </div>
</template>
<script>
import sideBar from "./sidebar.vue";

export default {
  props: ["posts"],
  components: {
    "side-bar": sideBar
  },
  created() {}
};
</script>
