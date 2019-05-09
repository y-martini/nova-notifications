<script>
    export default {
        name: "NovaNotifications",

        data () {
            return {
            }
        },

        created () {
            this.listenForNotifications();
        },

        methods: {
            listenForNotifications: function () {
                window.userPrivateChannel
                    .notification((notification) => {
                        // window.console.log(notification);
                        let notificationData = notification.data;

                        Notification.requestPermission( () => {
                            let notification = new Notification(notificationData.title, {
                                // actions?: NotificationAction[];
                                // badge?: string;
                                // body?: string;
                                // data?: any;
                                // dir?: NotificationDirection;
                                // icon?: string;
                                // image?: string;
                                // lang?: string;
                                // renotify?: boolean;
                                // requireInteraction?: boolean;
                                // silent?: boolean;
                                // tag?: string;
                                // timestamp?: number;
                                // vibrate?: VibratePattern;
                                body: notificationData.message, // content for the alert
                                icon: Nova.config.icon_path // optional image url
                            });

                            // link to page on clicking the notification
                            notification.onclick = () => {
                                window.open(notificationData.url, notificationData.target || '_blank').focus();
                            };
                        });
                    });
            },
        },
    }
</script>

<style scoped>

</style>
