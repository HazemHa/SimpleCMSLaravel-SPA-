<template>
  <div>
    <!--================ Hero sm Banner start =================-->
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner hero-banner--sm">
          <div class="hero-banner__content">
            <h1>Post details</h1>
            <nav aria-label="breadcrumb" class="banner-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <router-link :to="{name:'home'}">
              <a href="#">Home</a>
            </router-link>

                </li>
                <li class="breadcrumb-item active" aria-current="page">Post Details</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero sm Banner end =================-->
    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="main_blog_details">
              <img class="img-fluid" :src="this.post.image" alt>
               <router-link :to="{name:'post-details',params:{id:this.post.id}}">
              <a href="#">
                <h4>
                  {{this.post.title}}
                </h4>
              </a>
              </router-link>
              <div class="user_details">
                <div class="float-right mt-sm-0 mt-3">
                  <div class="media">
                    <div class="media-body">
                      <h5>{{this.post.user.name}}</h5>
                      <p>
                      <timeago :datetime="this.post.created_at"></timeago>
                      </p>
                    </div>
                    <div class="d-flex">
                      <img width="42" height="42" :src="this.post.image" alt>
                    </div>
                  </div>
                </div>
              </div>
              <p>{{this.post.content}}</p>
              <div class="news_d_footer flex-column flex-sm-row">
                <a class="justify-content-sm-center ml-sm-auto mt-sm-0 mt-2" href="#"></a>
                <div class="news_socail ml-sm-auto mt-sm-0 mt-2">
                  <a href="#">
                    <i class="fab fa-facebook-f"></i>
                  </a>
                  <a href="#">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a href="#">
                    <i class="fab fa-dribbble"></i>
                  </a>
                  <a href="#">
                    <i class="fab fa-behance"></i>
                  </a>
                </div>
              </div>
            </div>

            <comment :post="this.post"></comment>
          </div>
          <side-bar></side-bar>
        </div>
      </div>
    </section>
    <!--================ End Blog Post Area =================-->
  </div>
</template>
<script>
import sideBar from "./parts/sidebar.vue";
import comment from "./parts/comment.vue";
export default {
  components: {
    "side-bar": sideBar,
    comment: comment
  },
  data() {
    return {
      post: {
        user: {}
      }
    };
  },
  created() {
    this.$store
      .dispatch("posts/blogDetails", { id: this.$route.params.id })
      .then(res => {
        this.post = res.Posts[0];
      })
      .catch(err => {
        this.$toaster.error(err);
      });
  },
  methods: {}
};
</script>

