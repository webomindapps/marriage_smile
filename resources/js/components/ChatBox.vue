<template>
    <div class="chat-area">
        <!-- chatbox -->
        <div class="chatbox">
            <div class="modal-dialog-scrollable">
                <div class="modal-content" v-if="receiver.id!=sender.id">
                    <div class="msg-head">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3>
                                    {{ receiver.name}}
                                </h3>
                            </div>
                            <div class="dropdown">
                                <i class="fas fa-ellipsis-v" @click="toggleDropdown"></i>
                                <ul v-show="isDropdownVisible" class="downdrp">
                                    <li @click="blockUser(receiver_per?.id)">
                                        <span v-if="receiver_per?.is_blocked">
                                            Unblock
                                        </span>
                                        <span v-else>
                                            Block
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="msg-body">
                            <ul class="px-2" ref="messagesBox">
                                <li
                                    v-for="(message, index) in messages"
                                    :key="index"
                                    :class="[
                                        message.sender_id === sender.id
                                            ? 'reply'
                                            : 'sender',
                                    ]"
                                >
                                    <p>{{ message.text }}</p>
                                    <span class="time">{{
                                        formatTimestamp(message.created_at)
                                    }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="send-box">
                        <input
                            type="text"
                            class="form-control"
                            v-model="newMessage"
                            @keyup.enter="sendMessage"
                            placeholder="Type a message..."
                        />
                        <button @click="sendMessage">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            Send
                        </button>
                    </div>
                </div>
                <div class="modal-content" v-else>
                    <p class="py-2 text-center">Select a conversation to start chatting</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { computed, nextTick, onMounted, ref, watch } from "vue";

export default {
    props: {
        receiver: {
            type: Object,
            required: true,
        },
        sender: {
            type: Object,
            required: true,
        },
        receiver_per: {
            type: Object,
            required: true,
        },
        sender_per: {
            type: Object,
            required: true,
        },
    },
    setup(props) {
        const conversations = ref([]);
        const messages = ref([]);
        const newMessage = ref("");
        const messagesBox = ref(null);
        const isDropdownVisible = ref(false); // Reactive reference for dropdown visibility

        const scrollToBottom = () => {
            messagesBox.value.scrollTop = messagesBox.value.scrollHeight;
        };

        watch(
            messages,
            () => {
                nextTick(() => {
                    scrollToBottom();
                });
            },
            { deep: true }
        );

        const sendMessage = () => {
            if (newMessage.value.trim() !== "") {
                axios
                    .post(`/messages/${props.receiver.id}`, {
                        message: newMessage.value,
                    })
                    .then((response) => {
                        newMessage.value = "";
                    });
            }
        };

        const formatTimestamp = (timestamp) => {
            const date = new Date(timestamp);
            return date.toLocaleTimeString([], {
                hour: "2-digit",
                minute: "2-digit",
                hour12: true,
            });
        };

        const getApproval = (senderId) => {
            window.location.href = `/chat/${senderId}/approve`;
        };

        const blockUser = (senderId) => {
            window.location.href = `/chat/${senderId}/block`;
        };

        const toggleDropdown = () => {
            isDropdownVisible.value = !isDropdownVisible.value;
        };

        const selectConversation = (conversation) => {
            window.location.href = `/chat/${conversation.id}`;
        };

        const getConversationImageUrl = (conversation) => {
            return "default.png";
        };

        // Computed property for image URL
        // const imageUrl = computed(() => {
        //     return `/storage/${props.receiver.image}`;
        // });

        onMounted(() => {
            axios.get(`/messages/${props.receiver.id}`).then((response) => {
                messages.value = response.data;
            });

            axios.get(`/conversations`).then((response) => {
                conversations.value = response.data;
            });

            Echo.private("marriage-chat").listen("MessageSent", (response) => {
                console.log(response);
                
                if (response.message) {
                    const messageExists = messages.value.some(
                        (msg) => msg.id === response.message.id
                    );
                    if (!messageExists) {
                        if (
                            (response.message.sender_id === props.sender.id &&
                                response.message.receiver_id === props.receiver.id) ||
                            (response.message.sender_id === props.receiver.id &&
                                response.message.receiver_id === props.sender.id)
                        ) {
                            messages.value.push(response.message);
                        }
                    }
                }
            });
        });

        return {
            conversations,
            messages,
            newMessage,
            messagesBox,
            isDropdownVisible, // Make isDropdownVisible available to the template
            sendMessage,
            formatTimestamp,
            selectConversation,
            getConversationImageUrl,
            getApproval,
            blockUser,
            toggleDropdown,
        };
    },
};
</script>

<style scoped>
.approv_btn{
    padding: 5px 10px;
    border-radius: 5px;
    background-color: #b38081;
    color: #fff;
    cursor: pointer;
}
.dropdown-container {
    position: relative;
    display: inline-block;
}

.downdrp {
    position: absolute;
    top: 30px;
    right: 0;
    list-style: none;
    background-color: white;
    border: 1px solid #ccc;
    padding: 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    /* display: none; */
}

.downdrp li {
    cursor: pointer;
    padding: 5px 10px;
}

.downdrp li:hover {
    background-color: #f0f0f0;
}
.user_img {
    height: 45px;
    width: 45px;
    border-radius: 50%;
}
.chat-area {
    position: relative;
    width: 100%;
    background-color: #fff;
    border-radius: 0.3rem;
    height: 80vh;
    overflow: hidden;
    min-height: calc(100% - 1rem);
}

.chatlist {
    outline: 0;
    height: 100%;
    overflow: hidden;
    width: 300px;
    float: left;
    padding: 15px;
}

.chat-area .modal-content {
    border: none;
    border-radius: 0;
    outline: 0;
    height: 100%;
}

.chat-area .modal-dialog-scrollable {
    height: 100% !important;
}

.chatbox {
    width: auto;
    overflow: hidden;
    height: 100%;
    border-left: 1px solid #ccc;
}

.chatbox .modal-dialog,
.chatlist .modal-dialog {
    max-width: 100%;
    margin: 0;
}

.msg-search {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.chat-area .form-control {
    display: block;
    width: 80%;
    padding: 0.375rem 0.75rem;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.5;
    color: #222;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ccc;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.chat-area .form-control:focus {
    outline: 0;
    box-shadow: inherit;
}

a.add img {
    height: 36px;
}

.chat-list h3 {
    color: #222;
    font-size: 16px;
    font-weight: 500;
    line-height: 1.5;
    text-transform: capitalize;
    margin-bottom: 0;
}

.chat-list p {
    color: #343434;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.5;
    text-transform: capitalize;
    margin-bottom: 0;
}

.chat-list a.d-flex {
    margin-bottom: 15px;
    position: relative;
    text-decoration: none;
}

.chat-list .active {
    display: block;
    content: "";
    clear: both;
    position: absolute;
    bottom: 3px;
    left: 34px;
    height: 12px;
    width: 12px;
    background: #00db75;
    border-radius: 50%;
    border: 2px solid #fff;
}

.msg-head h3 {
    color: #222;
    font-size: 18px;
    font-weight: 600;
    line-height: 1.5;
    margin-bottom: 0;
}

.msg-head p {
    color: #343434;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.5;
    text-transform: capitalize;
    margin-bottom: 0;
}

.msg-head {
    padding: 15px;
    border-bottom: 1px solid #ccc;
}

.msg-body ul {
    overflow: hidden;
}

.msg-body ul li {
    list-style: none;
    margin: 15px 0;
}

.msg-body ul li.sender {
    display: block;
    width: 100%;
    position: relative;
}

.msg-body ul li.sender:before {
    display: block;
    clear: both;
    content: "";
    position: absolute;
    top: -6px;
    left: -7px;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 12px 15px 12px;
    border-color: transparent transparent #f5f5f5 transparent;
    -webkit-transform: rotate(-37deg);
    -ms-transform: rotate(-37deg);
    transform: rotate(-37deg);
}

.msg-body ul li.sender p {
    color: #000;
    font-size: 14px;
    line-height: 1.5;
    font-weight: 400;
    padding: 15px;
    background: #f5f5f5;
    display: inline-block;
    border-bottom-left-radius: 10px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    margin-bottom: 0;
}

.msg-body ul li.sender p b {
    display: block;
    color: #b38081;
    font-size: 14px;
    line-height: 1.5;
    font-weight: 500;
}

.msg-body ul li.reply {
    display: block;
    width: 100%;
    text-align: right;
    position: relative;
}

.msg-body ul li.reply:before {
    display: block;
    clear: both;
    content: "";
    position: absolute;
    bottom: 15px;
    right: -7px;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 12px 15px 12px;
    border-color: transparent transparent #b38081 transparent;
    -webkit-transform: rotate(37deg);
    -ms-transform: rotate(37deg);
    transform: rotate(37deg);
}

.msg-body ul li.reply p {
    color: #fff;
    font-size: 14px;
    line-height: 1.5;
    font-weight: 400;
    padding: 15px;
    background: #b38081;
    display: inline-block;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    border-bottom-left-radius: 10px;
    margin-bottom: 0;
}

.msg-body ul li.reply p b {
    display: block;
    color: #b38081;
    font-size: 14px;
    line-height: 1.5;
    font-weight: 500;
}

.msg-body ul li.reply:after {
    display: block;
    content: "";
    clear: both;
}

.time {
    display: block;
    color: #000;
    font-size: 12px;
    line-height: 1.5;
    font-weight: 400;
}

li.reply .time {
    margin-right: 20px;
}

.divider {
    position: relative;
    z-index: 1;
    text-align: center;
}

.msg-body h6 {
    text-align: center;
    font-weight: normal;
    font-size: 14px;
    line-height: 1.5;
    color: #222;
    background: #fff;
    display: inline-block;
    padding: 0 5px;
    margin-bottom: 0;
}

.divider:after {
    display: block;
    content: "";
    clear: both;
    position: absolute;
    top: 12px;
    left: 0;
    border-top: 1px solid #ebebeb;
    width: 100%;
    height: 100%;
    z-index: -1;
}

.send-box {
    padding: 15px;
    border-top: 1px solid #ccc;
}

.send-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 15px;
}

.send-box .form-control {
    display: block;
    width: 85%;
    padding: 0.375rem 0.75rem;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.5;
    color: #222;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ccc;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.send-box button {
    border: none;
    background: #b38081;
    padding: 0.375rem 5px;
    color: #fff;
    border-radius: 0.25rem;
    font-size: 14px;
    font-weight: 400;
    width: 24%;
    margin-left: 1%;
}

.send-box button i {
    margin-right: 5px;
}

button:focus {
    outline: 0;
}

.add-apoint {
    display: inline-block;
    margin-left: 5px;
}

.add-apoint a {
    text-decoration: none;
    background: #f6f7fa;
    border-radius: 8px;
    padding: 8px 8px;
    font-size: 13px;
    font-weight: 400;
    line-height: 1.2;
    color: #343945;
}

.add-apoint a svg {
    margin-right: 5px;
}

.chat-icon {
    display: none;
}
.chat-list .atvcht{
    background: #eee0e0;
}
</style>
