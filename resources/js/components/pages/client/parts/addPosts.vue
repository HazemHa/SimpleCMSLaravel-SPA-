<template>
  <form>
    <v-text-field
      v-model="title"
      :error-messages="requriedMessage"
      label="title"
      required
      @input="$v.requiredField.$touch()"
      @blur="$v.requiredField.$touch()"
    ></v-text-field>
    <v-textarea
      v-model="content"
      :error-messages="requriedMessage"
      label="content"
      required
      @input="$v.requiredField.$touch()"
      @blur="$v.requiredField.$touch()"
    ></v-textarea>
    <v-flex xs12 sm6 d-flex>
      <v-select
        :items="category"
        v-model="category_id"
        label="Categroy"
        item-value="id"
        item-text="name"
        return-object
      ></v-select>
    </v-flex>


    <v-select
      :items="status"
      v-model="status_id"
      label="Status"
      item-value="id"
      item-text="name"
      return-object
    ></v-select>

    <v-flex xs12>
      <image-input v-model="avatar" @input="ReceiveImage">
        <div slot="activator">
          <v-avatar size="280px" v-ripple v-if="!avatar" class="grey lighten-3 mb-3">
            <span>Click to add avatar</span>
          </v-avatar>
          <v-avatar size="280px" v-ripple v-else class="mb-3">
            <img :src="avatar.imageURL" alt="avatar">
          </v-avatar>
        </div>
      </image-input>
    </v-flex>

    <v-btn @click="submit">submit</v-btn>
    <v-btn @click="clear">clear</v-btn>
  </form>
</template>
<script>
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
import ImageInput from "../../../image/imageUpload.vue";

export default {
  mixins: [validationMixin],
  validations: {
    requiredField: { required }
  },
  components: {
    ImageInput: ImageInput
  },
  data: () => ({
    category: [{ id: 1, name: "Foo" }],
    status: [{ id: 1, name: "Foo" }],
    tempImageAsFile: null,
    avatar: { imageURL: "" },

    title: "",
    content: "",
    category_id: -1,
    status_id: -1,
    image: ""
  }),
  mounted() {
    this.$store
      .dispatch("category/getCategoryMenu")
      .then(res => {
        this.category = res.Category;
      })
      .catch(err => {});

    this.$store
      .dispatch("status/getStatusMenu")
      .then(res => {
        this.status = res.Status;
      })
      .catch(err => {});
  },

  computed: {
    requriedMessage() {
      const errors = [];
      if (!this.$v.requiredField.$dirty) return errors;
      !this.$v.requiredField.required && errors.push("this field is required.");
      return errors;
    }
  },
  methods: {
    submit() {
      this.$v.$touch();


const formData = new FormData();
        formData.append("title",this.title);
        formData.append("content", this.content);
        formData.append("category_id", this.category_id.id);
        formData.append("status_id", this.status_id.id);
        formData.append("image", this.tempImageAsFile);
        formData.append("user_id", this.$store.getters["users/getCurrentUser"].id);


      this.$store
          .dispatch("posts/storePostClient", formData)
          .then((res) => {
                 if (res.data.success) {
              this.$toaster.success(res.data.success);
            } else if (res.data.error) {
              this.$toaster.error(res.data.error);
            }

          })
          .catch((err) => {
            console.log(err);
          });
    },
    clear() {
      this.$v.$reset();
      this.user_id = "";
      this.title = "";
      this.content = "";
      this.category_id = "";
      this.image = "";
      this.status_id = "";
    },
    ReceiveImage(file) {
      this.tempImageAsFile = file.file;
    }
  }
};
</script>
