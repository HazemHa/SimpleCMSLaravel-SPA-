<template>
  <div>
    <!--================Header Menu Area =================-->
    <header class="header_area">
      <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container box_1620">
            <!-- Brand and toggle get grouped for better mobile display -->
            <router-link :to="{name:'home'}">
              <a class="navbar-brand logo_h" href="#">
                <img src="img/logo.png" alt>
              </a>
            </router-link>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="#navbarSupportedContent"
              aria-expanded="true"
              aria-label="Toggle navigation"
            >
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
              <span class="nav navbar-nav menu_nav justify-content-center">
                <li class="nav-item active">
                  <router-link class="nav-link" :to="{ name: 'home'}">Home</router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" :to="{ name: 'contact'}">contact</router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" :to="{ name: 'category'}">category</router-link>
                </li>
                <li class="nav-item" v-if="!$store.getters['users/isAuth']">
                  <router-link class="nav-link" :to="{ name: 'singin'}">singin</router-link>
                </li>
                <li class="nav-item" v-if="!$store.getters['users/isAuth']">
                  <router-link class="nav-link" :to="{ name: 'singup'}">singup</router-link>
                </li>
                <li class="nav-item" v-if="$store.getters['users/isAuth']">
                  <router-link class="nav-link" :to="{ name: 'addPost'}">add Post</router-link>
                </li>

                <li class="nav-item" v-if="$store.getters['users/isAuth']">
                  <router-link class="nav-link" :to="{ name: 'profile'}">profile</router-link>
                </li>

                <li class="nav-item" v-if="$store.getters['users/isAuth']">
                  <a href="/#" @click="logout" class="nav-link">logout</a>
                </li>

                <li class="nav-item submenu dropdown"></li>
              </span>
              <ul class="nav navbar-nav navbar-right navbar-social">
                <li>
                  <a href="#">
                    <i class="ti-facebook"></i>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="ti-twitter-alt"></i>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="ti-instagram"></i>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="ti-skype"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <main class="site-main">
      <router-view></router-view>
    </main>

    <!--================ Start Footer Area =================-->
    <footer class="footer-area section-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="single-footer-widget">
              <h6>About Us</h6>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                dolore
                magna aliqua.
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="single-footer-widget">
              <h6>Newsletter</h6>
              <p>Stay update with our latest</p>
              <div class id="mc_embed_signup">
                <form
                  target="_blank"
                  novalidate="true"
                  action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                  method="get"
                  class="form-inline"
                >
                  <div class="d-flex flex-row">
                    <input
                      class="form-control"
                      name="EMAIL"
                      placeholder="Enter Email"
                      onfocus="this.placeholder = ''"
                      onblur="this.placeholder = 'Enter Email '"
                      required
                      type="email"
                    >

                    <button class="click-btn btn btn-default">
                      <span class="lnr lnr-arrow-right"></span>
                    </button>
                    <div style="position: absolute; left: -5000px;">
                      <input
                        name="b_36c4fd991d266f23781ded980_aefe40901a"
                        tabindex="-1"
                        value
                        type="text"
                      >
                    </div>

                    <!-- <div class="col-lg-4 col-md-4">
                        <button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
                    </div>-->
                  </div>
                  <div class="info"></div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="single-footer-widget mail-chimp">
              <h6 class="mb-20">Instragram Feed</h6>
              <ul class="instafeed d-flex flex-wrap">
                <li>
                  <img src="img/instagram/i1.jpg" alt>
                </li>
                <li>
                  <img src="img/instagram/i2.jpg" alt>
                </li>
                <li>
                  <img src="img/instagram/i3.jpg" alt>
                </li>
                <li>
                  <img src="img/instagram/i4.jpg" alt>
                </li>
                <li>
                  <img src="img/instagram/i5.jpg" alt>
                </li>
                <li>
                  <img src="img/instagram/i6.jpg" alt>
                </li>
                <li>
                  <img src="img/instagram/i7.jpg" alt>
                </li>
                <li>
                  <img src="img/instagram/i8.jpg" alt>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="single-footer-widget">
              <h6>Follow Us</h6>
              <p>Let us be social</p>
              <div class="footer-social d-flex align-items-center">
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
        </div>
        <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap"></div>
      </div>
    </footer>
    <!--================ End Footer Area =================-->
  </div>
</template>
<script>
export default {
  created() {
    const self = this;
    setTimeout(function() {
      self.$store
        .dispatch("users/setTokenForRequest")
        .then(function(value) {
          if (value) {
            self.$nextTick();
          } else {
            self.$nextTick();
          }
        }).catch(err=>{
          
        });
    }, 1000);
    
  },
  methods: {
    logout() {
      this.$store
        .dispatch("users/logout")
        .then(res => {
          if (!res.data.auth) {
            this.$toaster.success("logout sucessfull");
            this.$router.push("/");
            this.$nextTick();
          }
        })
        .catch(err => {
          this.$toaster.error(err);
        });
    }
  }
};
</script>
