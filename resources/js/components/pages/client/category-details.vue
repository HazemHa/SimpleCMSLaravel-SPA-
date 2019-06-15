<template>
  <div>
    <main class="site-main">
      <!--================Hero Banner start =================-->
      <section class="mb-30px">
        <div class="container">
          <div class="hero-banner">
            <div class="hero-banner__content">
              <h3>{{ this.category.name}}</h3>
              <h4>
                <timeago :datetime=" this.category.created_at"></timeago>
              </h4>
            </div>
          </div>
        </div>
      </section>
      <!--================Hero Banner end =================-->
      <post :posts="this.category.posts"></post>
      <!--================ Start Blog Post Area =================-->
      <!--================ End Blog Post Area =================-->
    </main>
  </div>
</template>
<script>
import sideBar from "./parts/sidebar.vue";
import comment from "./parts/comment.vue";
import posts from "./parts/posts.vue";

export default {
  components: {
    "side-bar": sideBar,
    comment: comment,
    post: posts
  },
  data() {
    return {
      category: {}
    };
  },
  created() {
    this.$store
      .dispatch("category/GetSpecificCategories", { id: this.$route.params.id })
      .then(res => {
        this.category = res.Category[0];
      })
      .catch(err => {
        this.$toaster.error(err);
      });
  },
  methods: {}
};
</script>

