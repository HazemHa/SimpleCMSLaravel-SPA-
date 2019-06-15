<template>
  <!-- Start Blog Post Siddebar -->
  <div class="col-lg-4 sidebar-widgets">
    <div class="widget-wrap">
      <div class="single-sidebar-widget newsletter-widget">
        <h4 class="single-sidebar-widget__title">Newsletter</h4>
        <div class="form-group mt-30">
          <div class="col-autos">
            <input
              v-model="email"
              type="text"
              class="form-control"
              id="inlineFormInputGroup"
              placeholder="Enter email"
              onfocus="this.placeholder = ''"
              onblur="this.placeholder = 'Enter email'"
            >
          </div>
        </div>
        <button class="bbtns d-block mt-20 w-100" @click="subcribe">Subcribe</button>
      </div>

      <div class="single-sidebar-widget post-category-widget">
        <h4 class="single-sidebar-widget__title">Catgory</h4>
        <ul class="cat-list mt-20">
          <li v-for="(item, index) in this.categories" :key="index">
            <router-link :to="{name:'category-details',params:{id:item.id}}">
              <a href="#" class="d-flex justify-content-between">
                <p>{{item.name}}</p>
                <p>({{item.posts.length}})</p>
              </a>
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- End Blog Post Siddebar -->
</template>
<script>
export default {
  data() {
    return {
      categories: [],
      email: ""
    };
  },
  created() {
    this.$store
      .dispatch("category/getCategory")
      .then(res => {
        this.categories = res.Category;
      })
      .catch(err => {
        console.log(err);
      });
  },
  methods: {
    subcribe() {
      this.$store
        .dispatch("subscribes/createSubscribes", { email: this.email })
        .then(res => {
          this.$toaster.success(
            "subscribe sucessfull for email " + res.data.data.email
          );

          console.log(res.mutationSubscribes.email);
        })
        .catch(err => {
          this.$toaster.error(err);
        });
    }
  }
};
</script>
