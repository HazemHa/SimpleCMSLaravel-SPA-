<template>
  <div>
    <div class="comments-area">
      <h4>{{post.comments == undefined?0:post.comments.length}} Comments</h4>
      <div class="comment-list">
        <div
          class="single-comment justify-content-between d-flex"
          v-for="(comment, index) in  post.comments"
          :key="index"
        >
          <div class="user justify-content-between d-flex">
            <div class="thumb">
              <img :src="comment.user.image" width="42" height="42" alt>
            </div>
            <div class="desc">
              <h5>
                <a href="#">{{comment.user.name}}</a>
              </h5>
              <p class="date">
         <timeago :datetime="comment.created_at"></timeago>
         </p>
              <p class="comment">{{comment.message}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="comment-form" v-if="showCommnet">
      <h4>Leave a Reply</h4>
      <form>
        <div class="form-group form-inline">
          <div class="form-group col-lg-6 col-md-6 name">
            <input
              type="text"
              class="form-control"
              id="name"
              v-model="name"
              placeholder="Enter Name"
              onfocus="this.placeholder = ''"
              onblur="this.placeholder = 'Enter Name'"
            >
          </div>
          <div class="form-group col-lg-6 col-md-6 email">
            <input
              type="email"
              class="form-control"
              id="email"
              v-model="email"
              placeholder="Enter email address"
              onfocus="this.placeholder = ''"
              onblur="this.placeholder = 'Enter email address'"
            >
          </div>
        </div>
        <div class="form-group">
          <input
            type="text"
            class="form-control"
            id="subject"
            v-model="subject"
            placeholder="Subject"
            onfocus="this.placeholder = ''"
            onblur="this.placeholder = 'Subject'"
          >
        </div>
        <div class="form-group">
          <textarea
            class="form-control mb-10"
            rows="5"
            name="message"
            v-model="message"
            placeholder="Messege"
            onfocus="this.placeholder = ''"
            onblur="this.placeholder = 'Messege'"
            required
          ></textarea>
        </div>
        <v-btn class="button submit_btn" @click="addComent">Post Comment</v-btn>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  props: ["post"],
  data() {
    return {
      name: undefined,
      email: undefined,
      subject: undefined,
      message: undefined,
      user_id: -1,
      showCommnet: false
    };
  },
  created() {
    // console.log(this.user_id);
    //  this.DPost.post_id = post.id;
  },
  mounted() {
    let store = this.$store;
    var self = this;
    setTimeout(function() {
      self.$nextTick(function() {
        if (store.getters["users/getCurrentUser"].id != -1) {
          self.user_id = store.getters["users/getCurrentUser"].id;
          self.showCommnet = true;
        } else self.showCommnet = false;
      });
    }, 1200);
  },
  methods: {
    addComent() {
      this.$store
        .dispatch("comments/createComments", {
          post_id: post.id,
          user_id: this.user_id,
          name: this.name,
          email: this.email,
          subject: this.subject,
          message: this.message
        })
        .then(res => {
          let result = res.mutationComments;
          result["user"] = this.$store.getters["users/getCurrentUser"];
          this.DPost.comments.push(result);
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>

