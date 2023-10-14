var qs = Qs;
var mixin_item_list = {
    methods: {
        loadError(error) {
            let app = this;
            if (error.response != undefined) {
                if (error.response.data.errors != null) {
                    if (Object.keys(error.response.data.errors).length == 0) {
                        Object.keys(app.errors).forEach(
                            (i) => (app.errors[i] = "")
                        );
                        Swal.fire("Thông báo", "", "warning");
                    } else {
                        Swal.fire(
                            "Thông báo",
                            "Vui lòng kiểm tra thông tin. " +
                                " " +
                                (error.response.data.msg != undefined
                                    ? error.response.data.msg
                                    : ""),
                            "warning"
                        );
                        for (var k in app.errors) {
                            if (error.response.data.errors[k] != null)
                                app.errors[k] =
                                    error.response.data.errors[k][0];
                            else app.errors[k] = "";
                        }
                    }
                } else {
                    if (error.response.data.message != undefined)
                        Swal.fire(
                            "Thông báo",
                            error.response.data.message != undefined
                                ? error.response.data.message
                                : "",
                            "warning"
                        );
                    if (error.response.data.msg != undefined)
                        Swal.fire(
                            "Thông báo",
                            "Vui lòng kiểm tra thông tin. " +
                                " " +
                                (error.response.data.msg != undefined
                                    ? error.response.data.msg
                                    : ""),
                            "warning"
                        );
                }
            }
        },
        async loadProvince(baseURL1 = false) {
            return new Promise(async (resolve, reject) => {
                await axios
                    .get(baseURL + `list-province`)
                    .then((res) => {
                        this.provinces = res.data.data;
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        async loadTypeOfWork(baseURL1 = false) {
            return new Promise(async (resolve, reject) => {
                await axios
                    .get(baseURL + `list-type-of-work`)
                    .then((res) => {
                        this.types_of_work = res.data.data;
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        async loadPaymentType(baseURL1 = false) {
            return new Promise(async (resolve, reject) => {
                await axios
                    .get(baseURL + `list-payment-type`)
                    .then((res) => {
                        this.payment_types = res.data.data;
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        async loadServiceCategory(baseURL1 = false) {
            return new Promise(async (resolve, reject) => {
                await axios
                    .get(baseURL + `list-service-category`)
                    .then((res) => {
                        this.service_categories = res.data.data;
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        async loadService(id,baseURL1 = false) {
            return new Promise(async (resolve, reject) => {
                if(id == '')
                {
                    this.services = [];
                    resolve([]);
                    return;
                }
                await axios
                    .get(baseURL + `list-service?service_category_id=${id}`)
                    .then((res) => {
                        this.services = res.data.data;
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        async handleSearchSelect2(path,data_key,$event,baseURL1 = false) {
            return new Promise(async (resolve, reject) => {
                this.$data[data_key] = [];
                await axios
                    .get(baseURL + `list-skill?search=${$event.target.value}`)
                    .then((res) => {
                        this.$data[data_key] = res.data.data;
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        removeDuplicates(array) {
            let uniq = {};
                return array.filter(obj => !uniq[obj.id] && (uniq[obj.id] = true))
        },
        handleAddItemToList(item,data_key){
            this.$data[data_key].push(item);
            this.$data[data_key] =  this.removeDuplicates(this.$data[data_key]);
            
        },
        handleRemoveItemOnList(item,data_key){
            if(Object.keys(item).length > 0)
                this.$data[data_key] = this.$data[data_key].filter(currentValue=>currentValue.id !== item.id);
        },
        async loadDistrict(id) {
            return new Promise(async (resolve, reject) => {
                if (id == "") {
                    resolve([]);
                }
                await axios
                    .get(baseURL + `list-district?province_id=${id}`)
                    .then((res) => {
                        this.districts = res.data.data;
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        async loadWard(id) {
            return new Promise(async (resolve, reject) => {
                if (id == "") {
                    resolve([]);
                }
                await axios
                    .get(baseURL + `list-ward?district_id=${id}`)
                    .then((res) => {
                        this.wards = res.data.data;
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        async LoadGet(path) {
            return new Promise(async (resolve, reject) => {
                await axios
                    .get(baseURL + path)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        async loadItems(filter, path) {
            return new Promise(async (resolve, reject) => {
                const response = await axios
                    .get(baseURL + path + "?" + qs.stringify(filter))
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        async removeItem(path, msg = false) {
            return new Promise(async (resolve, reject) => {
                var conf = confirm(!msg ? "Bạn chắc chắn xóa?" : msg);
                if (conf)
                    await axios
                        .delete(path)
                        .then((res) => {
                            alert("Xóa thành công!");
                            resolve(res);
                        })
                        .catch((error) => {
                            reject(error);
                        });
                else reject(false);
            });
        },
        async handlePost(item, path) {
            return new Promise(async (resolve, reject) => {
                const response = await axios
                    .post(path, item, {
                        headers: { Authorization: `bearer ${typeof user_token !== 'undefined'? user_token : ''}` },
                    })
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        async sendMessage(item, path) {
            return new Promise(async (resolve, reject) => {
                const response = await axios
                    .post(path, item, {
                        headers: { Authorization: `bearer ${typeof user_token !== 'undefined'? user_token : ''}` },
                    })
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
    },
};
