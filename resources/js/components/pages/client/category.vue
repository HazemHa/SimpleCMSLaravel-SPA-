<template>
  <div>
    <!--================ Hero sm Banner start =================-->
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner hero-banner--sm">
          <div class="hero-banner__content">
            <h1>{{this.categories[0].name}}</h1>
            <nav aria-label="breadcrumb" class="banner-breadcrumb">
              <ol class="breadcrumb">
                <router-link :to="{name:'home'}">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                </router-link>
                <li
                  class="breadcrumb-item active"
                  aria-current="page"
                >{{this.categories[0].name}} Page</li>
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
            <div class="row">
              <div class="col-md-6" v-for="category in this.categories" :key="category.id">
                <div class="single-recent-blog-post card-view">
                  <div class="thumb">
                    <ul class="thumb-info">
                      <li>
                        <a href="#">
                          <i class="ti-user"></i>
                          {{category.name}}
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="ti-themify-favicon"></i>
                          {{category.posts.length}} Posts
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="details mt-20">
                    <router-link :to="{name:'category-details',params:{id:category.id}}">
                      <a href="#">
                        <h3>{{category.name}}</h3>
                      </a>
                    </router-link>
                    <p>{{category.description}}</p>
                    <router-link :to="{name:'category-details',params:{id:category.id}}">
                      <a class="button" href="#">
                        Read More
                        <i class="ti-arrow-right"></i>
                      </a>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <nav class="blog-pagination justify-content-center d-flex">
                  <ul class="pagination">
                    <li class="page-item">
                      <a href="#" class="page-link" aria-label="Previous">
                        <span aria-hidden="true">
                          <i class="ti-angle-left"></i>
                        </span>
                      </a>
                    </li>
                    <li class="page-item active">
                      <a href="#" class="page-link">1</a>
                    </li>
                    <li class="page-item">
                      <a href="#" class="page-link">2</a>
                    </li>
                    <li class="page-item">
                      <a href="#" class="page-link" aria-label="Next">
                        <span aria-hidden="true">
                          <i class="ti-angle-right"></i>
                        </span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- Start Blog Post Siddebar -->
        <!-- End Blog Post Siddebar -->
      </div>
    </section>
    <!--================ End Blog Post Area =================-->
  </div>
</template>
<script>
import sidebar from "./parts/sidebar.vue";
export default {
  data() {
    return {
      categories: [
        {
          id: "66",
          name: "kenyatta pagac",
          description:
            "dolorem atque quam aut saepe et optio exercitationem et. vel sunt sunt deleniti esse dicta ipsum. consequatur quae cupiditate in eos quia sed vel. ut quidem voluptatum eum sunt quos.",
          updated_at: "2019-03-18 08:52:36",
          created_at: "2019-03-18 08:52:36",
          posts: [
            {
              id: "1",
              title: "miss ruthe dickens sr.",
              content:
                "ut esse ipsam ab id est. iste optio quod deserunt dolor est enim repellat magni. in qui autem quas aut est. qui minima qui qui nemo sunt temporibus. qui velit officia nihil libero minus quo tempora. sunt debitis consequatur animi aut. et assumenda pariatur nostrum hic dicta quisquam. voluptas qui unde tempora architecto minus quia. aut dolorem quo in commodi. veritatis expedita autem est quod incidunt hic. ea sit quia qui quidem accusamus. qui recusandae sit sint aperiam voluptate eligendi.",
              image: "https://lorempixel.com/640/480/?55840",
              status: {
                name: "gunnar jenkins ii"
              },
              created_at: "2019-03-18 08:52:37",
              category: {
                id: "66",
                name: "kenyatta pagac"
              },
              user: {
                id: "56",
                name: "Ford Spinka"
              },
              comments: []
            }
          ]
        }
      ]
    };
  },
  created() {
    this.$store
      .dispatch("category/getCategory")
      .then(res => {
        this.categories = res.Category;
      })
      .catch(err => {
        this.$toaster.error(err);
      });
  }
};
</script>

