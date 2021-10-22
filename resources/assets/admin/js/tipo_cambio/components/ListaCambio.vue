<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12 mb-5">
                <a href="/admin/tipo-cambio/crear" class="btn btn-primary float-right" type="button">Crear registro</a>
            </div>
            <div class="col-lg-12 p-0">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Nro.</th>
                                <th>T. COMPRA</th>
                                <th>T. VENTA</th>
                                <th>PAIS</th>
                                <th>TIPO MONEDA</th>
                                <th>ESTADO</th>
                                <th>FECHA REGISTRO</th>
                                <th>FECHA EDICION</th>
                                <th v-if="rol=='Administrator'">FECHA ELIMINADO</th>
                                <th v-if="rol=='Administrator'">ACCIONES</th>

                            </tr>
                        </thead>
                        <tbody v-if="lista.data.length> 0">
                            <tr v-for="(li,index) in lista.data" :key="li.id" v-show="!loading" :class="li.deleted_at ? 'tc-delete' : ''">
                                <td scope="row">{{index+1}}</td>
                                <td>{{li.valor_compra}}</td>
                                <td>{{li.valor_venta}}</td>
                                <td>{{li.pais}}</td>
                                <td>{{li.tipo_moneda}}</td>
                                <td>
                                    <b-badge variant="success" v-if="li.activo==1">Activo</b-badge>
                                    <b-badge variant="danger" v-else>Desactivado</b-badge>
                                </td>
                                <td>{{li.created_at | dateFormat()}}</td>
                                <td>{{li.updated_at | dateFormat()}}</td>
                                <td v-if="rol=='Administrator'">{{li.deleted_at | dateFormat()}}</td>
                                <td v-if="rol=='Administrator'">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cogs"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item"    :href="`/admin/tipo-cambio/edit/${li.id}`" 
                                                                    v-if="!li.deleted_at">Editar
                                        </a>
                                        <a class="dropdown-item"    href="javascript:void(0);" 
                                                                    @click.prevent="eliminar(li.id)" 
                                                                    v-if="!li.deleted_at">Eliminar
                                        </a>
                                        <a class="dropdown-item"    href="javascript:void(0);" 
                                                                    @click.prevent="eliminarForce(li.id)" 
                                                                    v-if="li.deleted_at && rol=='Administrator'">Eliminar permanentemente
                                        </a>
                                        <a class="dropdown-item"    href="javascript:void(0);" 
                                                                    @click.prevent="changeEstado(li.id)" 
                                                                    v-if="!li.deleted_at">{{li.activo==1 ? "Desactivar" : "Activar"}}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr v-show="loading">
                                <th colspan="9" class="text-center">
                                    <b-spinner type="grow" label="Loading..."></b-spinner>
                                </th>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr v-show="!loading">
                                <th colspan="9" class="text-center">
                                    No hay tipos de cambio registrados...
                                </th>
                            </tr>
                            <tr v-show="loading">
                                <th colspan="9" class="text-center">
                                    <b-spinner type="grow" label="Loading..."></b-spinner>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pagination justify-content-center">
                        <pagination :data="lista" @pagination-change-page="load"></pagination>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';
export default {
    props:['rol'],
    data() {
        return {
            loading: false,
            lista:{data:[]},
        }
    },
    mounted() {
        this.load();
    },
    methods: {
        async load(page = 1){
            this.loading = true;
            try {
                this.$TcApi
                    .get(page)
                    .then((rs)=>{
                        console.log(rs);
                        this.loading = false
                        this.lista = rs.data;
                    })
            } catch (e) {
                this.loading = false
                console.log(e)
            }
        },
        eliminar(id){
            this.$swal.fire({
                title: 'Esta seguro que desea eliminar el registro?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$TcApi
                            .eliminar(id)
                            .then(({data})=>{
                                console.log(data);
                                if (data.delete) {
                                    const TC = this.lista.data.find(n=>n.id==id)
                                    Vue.set(TC,"deleted_at",data.fecha);
                                    this.$swal.fire('',`${data.message}`,'success')
                                }else{
                                    this.$swal.fire('',`${data.message}`,'error')
                                }
                            })
                            .catch(e=>{
                                console.log(e)
                            })
                    }
                })
        },
        eliminarForce(id){
            this.$swal.fire({
                title: 'Esta seguro que desea eliminar de manera permanentemente este registro?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$TcApi
                            .eliminarForce(id)
                            .then(({data})=>{
                                if (data.delete) {
                                    this.load();
                                    this.$swal.fire('',`${data.message}`,'success')
                                }else{
                                    this.$swal.fire('',`${data.message}`,'error')
                                }
                            })
                            .catch(e=>{
                                console.log(e)
                            })
                    }
                })
        },
        changeEstado(id){
            this.$TcApi
                .changeEstado(id)
                .then(({data})=>{
                    if (data.change) {
                        const TC = this.lista.data.find(n=>n.id==id)
                        Vue.set(TC,"activo",data.activo);
                        this.$swal.fire('',`${data.message}`,'success')
                    }else{
                        this.$swal.fire('',`${data.message}`,'error')
                    }
                })
        },
    },
}
</script>

<style lang="scss" scoped>

</style>