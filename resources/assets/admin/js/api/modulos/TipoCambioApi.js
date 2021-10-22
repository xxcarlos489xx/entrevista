import Api from '../Api'
const resource = '/tipo-cambio'

export default {
    get(page) {
        return Api.get(`${resource}/all?page=${page}`);
    },
    save(data) {
        return Api.post(`${resource}/save`,data);
    },
    edit(data) {
        return Api.post(`${resource}/edit`,data);
    },
    eliminar(id) {
        return Api.post(`${resource}/eliminar/${id}`);
    },
    eliminarForce(id) {
        return Api.post(`${resource}/eliminar-force/${id}`);
    },
    changeEstado(id){
        return Api.post(`${resource}/changeEstado/${id}`);
    }
}