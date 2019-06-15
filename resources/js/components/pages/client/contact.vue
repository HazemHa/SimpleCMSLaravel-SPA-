<template>
  <div>
    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
      <div class="container">
        <div class="d-none d-sm-block mb-5 pb-4"></div>

        <div class="row">
          <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
            <div class="media contact-info">
              <span class="contact-info__icon">
                <i class="ti-home"></i>
              </span>
              <div class="media-body">
                <h3>California United States</h3>
                <p>Santa monica bullevard</p>
              </div>
            </div>
            <div class="media contact-info">
              <span class="contact-info__icon">
                <i class="ti-headphone"></i>
              </span>
              <div class="media-body">
                <h3>
                  <a href="tel:454545654">00 (440) 9865 562</a>
                </h3>
                <p>Mon to Fri 9am to 6pm</p>
              </div>
            </div>
            <div class="media contact-info">
              <span class="contact-info__icon">
                <i class="ti-email"></i>
              </span>
              <div class="media-body">
                <h3>
                  <a href="mailto:support@colorlib.com">support@colorlib.com</a>
                </h3>
                <p>Send us your query anytime!</p>
              </div>
            </div>
          </div>
          <div class="col-md-8 col-lg-9">
            <div>
              <div class="row">
                <div class="col-lg-5">
                  <div class="form-group">
                    <input
                      class="form-control"
                      name="name"
                      v-model="name"
                      id="name"
                      type="text"
                      placeholder="Enter your name"
                    >
                  </div>
                  <div class="form-group">
                    <input
                      class="form-control"
                      name="email"
                      id="email"
                      v-model="email"
                      type="email"
                      placeholder="Enter email address"
                    >
                  </div>
                  <div class="form-group">
                    <input
                      class="form-control"
                      name="subject"
                      id="subject"
                      v-model="subject"
                      type="text"
                      placeholder="Enter Subject"
                    >
                  </div>
                </div>
                <div class="col-lg-7">
                  <div class="form-group">
                    <textarea
                      class="form-control different-control w-100"
                      name="message"
                      v-model="content"
                      id="message"
                      cols="30"
                      rows="5"
                      placeholder="Enter Message"
                    ></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group text-center text-md-right mt-3">
                <button
                  @click="sendMessage"
                  type="submit"
                  class="button button--active button-contactForm"
                >Send Message</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ contact section end ================= -->
  </div>
</template>
<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      subject: "",
      content: ""
    };
  },
  created() {},
  methods: {
    sendMessage() {
      this.$store
        .dispatch("messages/createMessages", {
          name: this.name,
          email: this.email,
          subject: this.subject,
          content: this.content
        })
        .then(res => {
          if (res.data.errors) {
            this.$toaster.error(res.data.errors[0].debugMessage);
          } else if (res.data.data.mutationMessages) {
            this.$toaster.success(
              "Message sended by " + res.data.data.mutationMessages.email
            );
          }
        })
        .catch(err => {
          this.$toaster.error(err);
        });
    }
  }
};
</script>
