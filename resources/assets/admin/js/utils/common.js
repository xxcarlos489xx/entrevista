export default {
    convertParameters (params) {
        let query = ''
        if (params === null || params === undefined) return query;
        let arr = Object.entries(params)
        if (arr.length > 0) {
            if (arr[0][1] !== '' && arr[0][1] !== null && arr[0][1] !== 'all' && arr[0][1] && arr[0][1] !== 'otros' && arr[0][1] !== undefined) {
                query += `?${arr[0][0]}=${arr[0][1]}`
            }
            if (arr.length >= 1) {

                for (let i = 1; i < arr.length; i++) {
                    if (arr[i][1] !== '' && arr[i][1] !== null && arr[i][1] !== 'all' && arr[i][1] !== 'otros' && arr[0][1] !== undefined) {
                        if (query === '') {
                            query += `?${arr[i][0]}=${arr[i][1]}`
                        } else {
                            query += `&${arr[i][0]}=${arr[i][1]}`
                        }
                    }
                }
            }
        }
        return query;
    },
}