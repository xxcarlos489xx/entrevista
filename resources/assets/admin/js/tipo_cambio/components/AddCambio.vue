<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Crear tipo de cambio <i class="fas fa-dollar-sign float-right"></i></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-6">
                                <label for="tc_c">Valor de compra</label>
                                <input  id="tc_c" 
                                        type="number" 
                                        class="form-control"
                                        :class="$v.form.tc_compra.$error ? 'is-invalid' : ''" 
                                        v-model="form.tc_compra"
                                        step="0.001" 
                                        max="5"
                                        min="3"
                                        placeholder="0.000">
                                <span class="text-danger" v-if='!$v.form.tc_compra.required && $v.form.tc_compra.$anyDirty'>
                                    El valor de compra es requerido
                                </span><br>
                                 <span class="text-danger" v-if="!$v.form.tc_compra.between">
                                    Rango permitido entre {{$v.form.tc_compra.$params.between.min}} y {{$v.form.tc_compra.$params.between.max}}
                                </span><br>
                                <span class="text-danger" v-if='!$v.form.tc_compra.decimal && $v.form.tc_compra.$anyDirty'>
                                    El valor debe ser un numero decimal
                                </span>
                            </div>
                            <div class="col-6">
                                <label for="tc_v">Valor de venta</label>
                                <input  id="tc_v" 
                                        type="number" 
                                        class="form-control" 
                                        :class="$v.form.tc_venta.$error ? 'is-invalid' : ''" 
                                        v-model="form.tc_venta"
                                        step="0.001" 
                                        max="5"
                                        min="3"
                                        placeholder="0.000">
                                <span class="text-danger" v-if="!$v.form.tc_venta.between">
                                    Rango permitido entre {{$v.form.tc_venta.$params.between.min}} y {{$v.form.tc_venta.$params.between.max}}
                                </span>
                                <span class="text-danger" v-if='!$v.form.tc_venta.required && $v.form.tc_venta.$anyDirty'>
                                    El valor de venta es requerido
                                </span><br>
                                <span class="text-danger" v-if='!$v.form.tc_venta.decimal && $v.form.tc_venta.$anyDirty'>
                                    El valor debe ser un numero decimal
                                </span><br>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-danger float-left" type="button" href="/admin/tipo-cambio">Cancelar</a>
                        <button class="btn btn-primary float-right" 
                                type="button" 
                                :disabled="loading"
                                @click.prevent="save">
                                <b-spinner small v-show="loading"></b-spinner>
                                Crear registro
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {required,decimal,between} from 'vuelidate/lib/validators';
export default {
    data () {
        return {
            loading:false,
            form:{
                tc_compra:'',
                tc_venta:'',
            }
        }
    },
    validations: {
        form: {
            tc_compra:{
                required,
                decimal,
                between: between(3, 5)
            },
            tc_venta:{
                required,
                decimal,
                between: between(3, 5)
            }
        }
    },
    methods: {
        save(){
            this.$v.$touch();
            if (!this.$v.$anyError){
                let formData = new FormData();
                formData.append("tc_compra",this.form.tc_compra)
                formData.append("tc_venta",this.form.tc_venta)
                this.loading = true
                this.$TcApi.save(formData)
                            .then(({data})=>{
                                if (data.save) {
                                    this.loading = false
                                    this.$swal.fire({
                                        title: `${data.message}!`,
                                        icon:'success',
                                        showCloseButton: false,
                                        allowOutsideClick:false,
                                        showCancelButton: false,
                                        confirmButtonText: `Aceptar`,
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location = '/admin/tipo-cambio';
                                            }
                                        })
                                }else{
                                    this.loading = false
                                }
                            })
                            .catch(e=>{
                                console.log(e)
                            })
            }
        }
    },
}
</script>

<style lang="scss" scoped>

</style>