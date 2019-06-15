<template>
  <div>
    <main class="site-main">
      <!--================Hero Banner start =================-->
      <section class="mb-30px">
        <div class="container">
          <div class="hero-banner">
            <div class="hero-banner__content">
              <h3>{{currentPost.category.name}}</h3>
              <h1>{{currentPost.title}}</h1>
              <h4>
                <timeago :datetime="currentPost.created_at"></timeago>
              </h4>
            </div>
          </div>
        </div>
      </section>
      <!--================Hero Banner end =================-->
      <post :posts="this.Posts"></post>
      <!--================ Start Blog Post Area =================-->
      <!--================ End Blog Post Area =================-->
    </main>
  </div>
</template>
<script>
import posts from "./parts/posts.vue";
export default {
  components: {
    post: posts
  },
  data() {
    return {
      Posts: [],
      currentPost: {
        id: "1",
        title: "miss ruthe dickens sr.",
        created_at: "",
        updated_at: "",
        content:
          "ut esse ipsam ab id est. iste optio quod deserunt dolor est enim repellat magni. in qui autem quas aut est. qui minima qui qui nemo sunt temporibus. qui velit officia nihil libero minus quo tempora. sunt debitis consequatur animi aut. et assumenda pariatur nostrum hic dicta quisquam. voluptas qui unde tempora architecto minus quia. aut dolorem quo in commodi. veritatis expedita autem est quod incidunt hic. ea sit quia qui quidem accusamus. qui recusandae sit sint aperiam voluptate eligendi.",
        image: "https://lorempixel.com/640/480/?55840",
        status: {
          name: "gunnar jenkins ii"
        },
        category: {
          name: "kenyatta pagac"
        },
        user: {
          name: "Ford Spinka"
        }
      },
      lastPost: {
        id: "1",
        title: "miss ruthe dickens sr.",
        created_at: "",
        updated_at: "",
        content:
          "ut esse ipsam ab id est. iste optio quod deserunt dolor est enim repellat magni. in qui autem quas aut est. qui minima qui qui nemo sunt temporibus. qui velit officia nihil libero minus quo tempora. sunt debitis consequatur animi aut. et assumenda pariatur nostrum hic dicta quisquam. voluptas qui unde tempora architecto minus quia. aut dolorem quo in commodi. veritatis expedita autem est quod incidunt hic. ea sit quia qui quidem accusamus. qui recusandae sit sint aperiam voluptate eligendi.",
        image: "https://lorempixel.com/640/480/?55840",
        status: {
          name: "gunnar jenkins ii"
        },
        comments: [],
        category: {
          name: "kenyatta pagac"
        },
        user: {
          name: "Ford Spinka"
        }
      }
    };
  },
  created() {
    this.$store
      .dispatch("posts/getPosts")
      .then(res => {
        if (res.Posts) {
          this.currentPost = res.Posts[0];
          this.Posts = res.Posts;
          this.lastPost = res.Posts[res.Posts.length - 1];
        }
      })
      .catch(err => {
        this.$toaster.error(err);
      });
  },
  mounted() {}
};
</script>
