<template>
    <div>
        <div id="organiser" class="tab-pane fade in">
            <div class="panel-group">
                <div class="panel panel-default lgx-panel">
                    <div class="panel-heading">
                        <form class="form-horizontal" ref="form" :action="submitUrl()" @submit.prevent="validateForm"
                            method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" id="csrf-token" :value="csrf_token" />

                            <div class="form-group row">
                                <label class="col-md-3">{{ trans("em.organization") }}
                                    {{ trans("em.name") }}*</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="organisation" type="text" v-validate="'required'"
                                        v-model="organisation" />
                                    <span v-show="errors.has('organisation')" class="help text-danger">{{
                                    errors.first("organisation")
                                    }}</span>
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                                <label class="col-md-3">{{
                                trans("em.description")
                                }}</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="org_description"
                                        v-model="org_description"></textarea>
                                    <span v-show="errors.has('org_description')" class="help text-danger">{{
                                    errors.first("org_description")
                                    }}</span>
                                </div>
                            </div> -->

                            <!-- <div class="form-group row">
                                <label class="col-md-3">{{  trans("em.facebook")}}</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="org_facebook" type="text"
                                        placeholder="e.g. www.facebook.com/YourPage" v-model="org_facebook" />
                                    <span v-show="errors.has('org_facebook')" class="help text-danger">{{
                                    errors.first("org_facebook")
                                    }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3">Instagram</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="org_instagram" type="text" v-model="org_instagram"
                                        placeholder="e.g. www.instagram.com/YourPage" />
                                    <span v-show="errors.has('org_instagram')" class="help text-danger">{{
                                    errors.first("org_instagram")
                                    }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3">YouTube</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="org_youtube" type="text" v-model="org_youtube"
                                        placeholder="e.g. www.youtube.com/channel/YourChannel" />
                                    <span v-show="errors.has('org_youtube')" class="help text-danger">{{
                                    errors.first("org_youtube") }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3">{{
                                trans("eventmie-pro::em.website")
                                }}</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="org_twitter" type="text" v-model="org_twitter"
                                        placeholder="e.g. www.yourwebsite.com" />
                                    <span v-show="errors.has('org_twitter')" class="help text-danger">{{
                                    errors.first("org_twitter") }}</span>
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <div class="col-md-9 offset-md-3">
                                    <button class="lgx-btn" type="submit">
                                        <i class="fas fa-sd-card"></i>
                                        {{ trans("em.save") }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import mixinsFilters from "../../mixins.js";
export default {
    props: ["user", "csrf_token"],

    mixins: [mixinsFilters],
    data() {
        return {
            organisation: null,
            org_description: null,
            org_facebook: null,
            org_instagram: null,
            org_youtube: null,
            org_twitter: null
        };
    },
    computed: {
        // get global variables
    },
    methods: {
        editProfile() {
            (this.organisation = this.user.organisation),
                (this.org_description = this.user.org_description),
                (this.org_facebook = this.user.org_facebook),
                (this.org_instagram = this.user.org_instagram),
                (this.org_youtube = this.user.org_youtube),
                (this.org_twitter = this.user.org_twitter);
        },

        // validate data on form submit
        validateForm(event) {
            this.$validator.validateAll().then(result => {
                if (result) {
                    this.formSubmit(event);
                }
            });
        },

        // show server validation errors
        serverValidate(serrors) {
            this.$validator.validateAll().then(result => {
                this.$validator.errors.add(serrors);
            });
        },

        // submit form
        async formSubmit(event) {
            this.$refs.form.submit();
        },

        submitUrl() {
            return route("eventmie.updateOrganiserUser");
        },
    },
    mounted() {
        this.editProfile();
    }
};
</script>
