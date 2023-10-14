var qs = Qs;
var mixin_io = {
    data() {
        return {
            socket: socket_io,
            base_url: baseUrlServer,
        };
    },
    methods: {
        async removeGroupApi(item){
            try {
                const response = await axios.delete(this.base_url + `groups/${item.id}`, {
                    headers: { Authorization: `bearer ${user_token}` },
                });
                return response;
            } catch (error) {
                return error;
            }
        },
        async fetchAuth() {
            try {
                const response = await axios.get(this.base_url + `auth/me`, {
                    headers: { Authorization: `bearer ${user_token}` },
                });
                return response;
            } catch (error) {
                return error;
            }
        },
        async loadGroupClient() {
            try {
                const response = await axios.get(
                    this.base_url + `groups/info`,
                    {
                        headers: { Authorization: `bearer ${user_token}` },
                    }
                );
                return response;
            } catch (error) {
                return error;
            }
        },
        async fetchGroups(filter) {
            try {
                const response = await axios.get(
                    this.base_url + `groups?${qs.stringify(filter)}`,
                    {
                        headers: { Authorization: `bearer ${user_token}` },
                    }
                );
                return response;
            } catch (error) {
                return error;
            }
        },
        async fetchMessages(filter) {
            try {
                const response = await axios.get(
                    this.base_url +
                        `groups/${filter.id}/messages?${qs.stringify(filter)}`,
                    {
                        headers: { Authorization: `Bearer ${user_token}` },
                    }
                );
                return response;
            } catch (error) {
                return error;
            }
        },
        async sendMessage(room,data,type_send = 'Content-Type": "application/json',file=false) {
            await axios
                .post(`${this.base_url}groups/${room}/messages`, data, {
                    headers: {type_send,Authorization: `Bearer ${user_token}` },
                })
                .then((res) => {
                    if(!file)
                        this.socket.emit("message:new", {
                            messageId: res.data.data.id,
                        }); // of socket
                    else
                    {
                        let data = {
                            messageId: res.data.data.id,
                              files: res.data.data.files[0].url,
                            };
                        this.socket.emit("message:file", data);
                        this.$refs['ref1'].value=null;
                    }
                });
        },
        async uploadMediasFileOfSocket(
            ref,
            id_data,
            id_url,
            category = "images",
            type = "staff",
            multiple = true
        ) {
            let app = this;
            if (
                multiple == false &&
                (this.$refs[ref].files.length >= 2 ||
                    this.$data[id_url].length >= 1)
            ) {
                Swal.fire("Thông báo", "Chỉ được tải lên 1 file", "warning");
                this.$refs[ref].files = null;
                return false;
            }
            if (
                multiple &&
                (this.$refs[ref].files.length >= multiple + 1 ||
                    this.$data[id_url].length >= multiple)
            ) {
                Swal.fire(
                    "Thông báo",
                    "Số file được tải lên " + multiple,
                    "warning"
                );
                this.$refs[ref].files = null;
                return false;
            }
            for (var i = 0; i < this.$refs[ref].files.length; i++) {
                let formData = new FormData();
                let file = this.$refs[ref].files[i];
                if (category == "auto") {
                    // up for banner
                    category = "images";
                    if (!file.type.match("image.*")) {
                        category = "videos";
                    }
                }

                if (category == "videos") formData.append("files", file);
                else formData.append("files[]", file);

                formData.append("type", type);

                await axios({
                    method: "post",
                    url: `${this.base_url}uploads/${category}`,
                    data: formData,
                    headers: {
                        "Content-Type": "multipart/form-data",
                        Authorization: `Bearer ${user_token}`,
                    },
                })
                    .then(function (response) {
                        if (response && response.data && response.data.data) {
                            let data =
                                category == "videos"
                                    ? response.data.data
                                    : response.data.data[0];
                            app.$data[id_data].push(data);
                            if (category != "videos")
                                app.$data[id_url].push({
                                    mediaType: "image",
                                    src: URL.createObjectURL(file),
                                });
                            else {
                                app.$data[id_url].push({
                                    mediaType: "iframe",
                                    autoplay: true,
                                    src: URL.createObjectURL(file),
                                });
                            }
                        }
                    })
                    .catch(function (error) {
                        if (
                            error.response &&
                            error.response.data &&
                            error.response.data.msg
                        )
                            Swal.fire(
                                "Thông báo",
                                error.response.data.msg,
                                "warning"
                            );
                        if (
                            error.response &&
                            error.response.data &&
                            error.response.data.message
                        )
                            Swal.fire(
                                "Thông báo",
                                error.response.data.message,
                                "warning"
                            );
                    });
            }
        },
        getFilenameAndExtension(pathfilename) {
            var filenameextension = pathfilename.replace(/^.*[\\\/]/, "");
            var filename = filenameextension.substring(
              0,
              filenameextension.lastIndexOf(".")
            );
            var ext = filenameextension.split(".").pop();
        
            return [filename, ext];
          },
        
          checkExtentFile(ext) {
            let extent = "";
            switch (ext) {
              case "jpeg":
                extent = "image";
                break;
              case "jpg":
                extent = "image";
                break;
              case "png":
                extent = "image";
                break;
              case "gif":
                extent = "image";
                break;
              case "gif":
                extent = "image";
                break;
              default:
                break;
            }
            return extent;
          },
        getLimitName(name) {
            if (name == undefined) return "";
            if (name == "") return name;
            var str = name;
            let acronym = str
                .split(/\s/)
                .reduce((response, word) => (response += word.slice(0, 1)), "");
            return acronym.split("").length > 2
                ? acronym.split("")[acronym.length - 2] +
                      acronym.split("")[acronym.length - 1]
                : acronym;
        },
        async removeMediasFile(index, id_data, id_url, api = false, method = "post") {
            if (api != false) {
              try {
                // let location = index - this.$data[id_data].length;
                await this.$axios({
                  method: method,
                  url: `${api}`,
                  data: { media_ids: [this.$data[id_url][index].id] },
                  headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${this.$store.state.auth.token}`,
                  },
                });
              } catch (error) {
                // console.log(1);
              }
            }
            if (this.$data[id_data].length <= 1) this.$data[id_data] = [];
            if (this.$data[id_url].length <= 1) this.$data[id_url] = [];
            if (
              this.$data[id_data].length == this.$data[id_url].length &&
              this.$data[id_data].length > 1 &&
              this.$data[id_url].length > 1
            ) {
              this.$data[id_data].splice(index, 1);
              this.$data[id_url].splice(index, 1);
            }
            if (this.$data[id_data].length != this.$data[id_url].length) {
              if (this.$data[id_data].length > 0)
                this.$data[id_data].splice(index - this.$data[id_data].length - 1, 1);
              this.$data[id_url] = this.$data[id_url].filter(
                (item, index1) => index1 !== index
              );
            }
          },
     
    },
};
