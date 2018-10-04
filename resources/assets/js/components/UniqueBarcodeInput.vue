<template>
    
    <div class="form-group col-sm-6">
        <label class="col-md-3 control-label">Codigo producto</label>
        <div class="col-md-9">
            <div class="input-group">
                <input
                    type="text"
                    name="barcode"
                    class="form-control"
                    maxlength="12"
                    v-model="value" />
                
                <span class="input-group-btn">
                    <button type="button" class="btn btn-info" @click="generate">Generar</button>
                </span>
            </div>

            <img class="vue-barcode-element"/>
        </div>
    </div>

</template>

<script>
    var JsBarcode = require('jsbarcode');

    export default {

        props: {
            barcode: {
                type: String,
                default: ''
            }
        },

        data()
        {
            return {
                state: {
                    value: null
                }
            }
        },

        computed: {
            value: {
                get() {
                    return this.state.value !== null ? this.state.value : this.barcode;
                },
                set(val) {
                    this.state.value = val;
                }
            }
        },

        methods: {
            generate()
            {
                this.state.value = Math.floor(Math.random() * 900000000000) + 100000000000;
            }
        },

        watch: {
            value: {
                immediate: true,
                handler() {
                    setTimeout(function() {
                        try {
                            var value = this.state.value || this.barcode;
                            JsBarcode(
                                this.$el.querySelector('.vue-barcode-element'),
                                value,
                                {
                                    format: "EAN13",
                                    width: 1,
                                    height: 20,
                                }
                            );
                        }
                        catch (e) {
                            this.$el.querySelector('.vue-barcode-element').setAttribute('src', '');
                        }
                    }.bind(this), 0);
                }
            }
        }
    }
</script>
