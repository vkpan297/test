<template>
    <div>
        <div id="BecomeOrganiser" class="tab-pane fade in">
            <div class="panel-group">
                <div class="panel panel-default lgx-panel">
                    <div class="panel-heading">
                        <div class="form-group row">
                            <label class="col-md-3">{{
                                trans("em.want_to_create_host")
                            }}</label>
                            <div class="col-md-9">
                                <button
                                    type="button"
                                    class="lgx-btn lgx-btn-black lgx-btn-sm"
                                    data-toggle="modal"
                                    data-target="#myModal"
                                >
                                    <i class="fas fa-person-booth"></i>
                                    {{ trans("em.become_organiser") }}
                                </button>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <div
                                class="col-md-12"
                                v-if="user.organisation && multi_vendor"
                            >
                                <div class="alert alert-info" role="alert">
                                    <strong>{{
                                        trans(
                                            "em.become_organiser_notification"
                                        )
                                    }}</strong>
                                </div>
                            </div>
                        </div>
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
        return {};
    },
    methods: {},
    mounted() {}
};
</script>
