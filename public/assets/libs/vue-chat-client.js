var chat = new Vue({
    mixins: [mixin_io],
    data() {
        return {
            text: "",
            user: {},
            loading_message: false,
            medias: [],
            images: [],
            group: {
                items: [],
                item: {},
                pagination: {
                    page: 1,
                    lastPage: 0,
                    last_page: 0,
                    perPage: 0,
                    total: 0,
                },
            },
            message: {
                items: [],
                item: {},
                pagination: {
                    page: 1,
                    lastPage: 0,
                    last_page: 0,
                    perPage: 0,
                    total: 0,
                },
            },
        };
    },
    methods: {
        // use for message
        sendMessApi() {
            let data = {};
            if (this.$refs["ref1"].files.length == 0) {
                data = {
                    text: this.text,
                    room: this.group.item.id,
                };
                this.sendMessage(this.group.item.id, data);
            } else {
                data = new FormData();
                data.append("files[]", this.$refs["ref1"].files[0]);
                data.append("text", this.text);
                this.sendMessage(
                    this.group.item.id,
                    data,
                    'Content-Type": "multipart/form-data',
                    true
                );
            }
            this.medias = [];
            this.images = [];
            this.text = "";
        },
        async handlePaginateMessage(page = 1) {
            let filter = {
                page: page,
                id: this.group.item.id,
            };
            try {
                await this.fetchMessages(filter).then((res) => {
                    let items = res.data;
                    this.message.items = [
                        ...new Set(
                            items.data.data.reverse().concat(this.message.items)
                        ),
                    ];
                    this.message.pagination.total = items.data.total;
                    this.message.pagination.perPage = items.data.perPage;
                    this.message.pagination.lastPage = items.data.last_page;
                    this.message.pagination = {
                        ...this.message.pagination,
                        page: items.data.current_page,
                    };
                });
            } catch (error) {}
        },
        handlePaginateGroup(page = 1) {
            let filter = {
                page: page,
            };
            this.fetchGroups(filter).then((res) => {
                // let items = res.data;
                // this.group.items = [
                //     ...new Set(
                //         items.data.data.reverse().concat(this.group.items)
                //     ),
                // ];
                let items = res.data;
                this.group.items = [
                    ...new Set(
                        items.data.data.reverse().concat(this.group.items)
                    ),
                ];
                this.group.pagination.total = items.data.total;
                this.group.pagination.perPage = items.data.perPage;
                this.group.pagination.lastPage = items.data.last_page;
                this.group.pagination = {
                    ...this.group.pagination,
                    page: items.data.current_page,
                };
            });
        },
        getMessage(msg) {
            if (msg.group_id == this.group.item.id) {
                if (msg.type == 2) {
                    if (msg.message.files) {
                        let file_upload = this.getFilenameAndExtension(
                            msg.message.files
                        );
                        if (file_upload.length > 0) {
                            msg.files = [
                                {
                                    mime_type:
                                        file_upload.length == 2
                                            ? this.checkExtentFile(
                                                  file_upload[1]
                                              )
                                            : "",
                                    name: file_upload[0],
                                    url: msg.message.files,
                                },
                            ];
                        }
                    }
                }
                this.setMessage(msg);
                if (msg.sender.id == this.user.root_id)
                    setTimeout(() => {
                        this.setScrollBottom();
                    }, 1000);
                else {
                    let data = {
                        room: msg.group_id,
                    };
                    this.socket.emit("message:received", data);
                }
            }
        },
        setMessage(msg) {
            this.message.items.push(msg);
        },
        initSocketOfMember() {
            this.fetchAuth().then((res) => {
                this.user = res.data.data.user;
                this.loadGroupClient().then((res) => {
                    this.group.item = res.data.data;
                    this.handlePaginateMessage().then(() => {
                        this.loading_message = true;
                    });
                });
            });
        },
        initSocketOfAdmin() {
            this.fetchAuth().then((res) => {
                this.user = res.data.data.user;
                this.handlePaginateGroup();
            });
        },
        onScrollMessage({ target: { scrollTop, clientHeight, scrollHeight } }) {
            var scroll = scrollHeight;
            if (
                scrollTop == 0 &&
                this.message.pagination.page < this.message.pagination.total
            )
                this.handlePaginateMessage(this.message.pagination.page + 1);
        },
        onScrollGroup({ target: { scrollTop, clientHeight, scrollHeight } }) {
            var scroll = scrollHeight;
            if (
                scrollTop == 0 &&
                this.group.pagination.page < this.group.pagination.total
            )
                this.handlePaginateGroup(this.group.pagination.page + 1);
        },
        setScrollBottom() {
            var messDisplay = this.$refs["messDisplay"];
            messDisplay.scrollTop = messDisplay.scrollHeight;
        },
        callChatBox(id) {
            $(id).collapse("show");
            if (this.loading_message) this.setScrollBottom();
            if (!this.loading_message && this.message.items.length == 0)
                setTimeout(() => {
                    this.setScrollBottom();
                }, 1500);
            this.loading_message = false;
        },
        closeChatBox(id) {
            $(id).collapse("hide");
            // this.setScrollBottom();
        },
        //group
        resetMessage() {
            this.text = "";
            this.medias = [];
            this.images = [];
            // this.$refs["ref1"].value = null;
            this.message = {
                items: [],
                item: {},
                pagination: {
                    page: 1,
                    lastPage: 0,
                    last_page: 0,
                    perPage: 0,
                    total: 0,
                },
            };
        },
        removeGroup(item) {
            var conf = confirm("Bạn chắc chắn xóa?");
            if (conf)
                this.removeGroupApi(item).then((res) => {
                    this.group.items = this.group.items.filter(
                        (currentValue) => currentValue.id !== item.id
                    );
                    this.closeGroup();
                });
        },
        closeGroup() {
            this.group.item = {};
            this.resetMessage();
        },
        setGroup(item) {
            this.group.item = item;
            this.resetMessage();
            this.handlePaginateMessage();
            setTimeout(() => {
                this.setScrollBottom();
            }, 1500);
        },
        removeImage(index) {
            this.removeMediasFile(index, `medias`, `images`);
        },
    },
    // created() {
    //     this.initSocketOfMember();
    // },
    mounted() {
        this.socket.on("message:new", (msg, cb) => {
            this.text = "";
            this.getMessage(msg);
        });
    },
}).$mount(`#${element_chat_id}`);
