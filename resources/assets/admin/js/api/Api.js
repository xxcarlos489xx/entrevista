import axios from 'axios';
const baseURL = '/admin/api';

export default axios.create({
    baseURL,
    headers: {
        'X-Requested-With' : 'XMLHttpRequest'
    }
})