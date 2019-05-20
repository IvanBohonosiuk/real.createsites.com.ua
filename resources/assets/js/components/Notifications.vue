<template>
    <ul id="slide-out" class="side-nav right-aligned">
        <li class="ui feed notification-item" v-if="hasUnreadNotifications" v-for="notification in notifications">
            <a :href="notification.data['link']">
                <i :class="'material-icons ' + notification.data['color_icon']">{{ notification.data['icon'] }}</i>
                <span>{{  notification.data['project']['title'] }}</span> <img class="responsive-img circle" style="width: 25px; position: relative; top: 10px;" :src="'/uploads/avatars/' + notification.data['author']['image']"> <small>{{ notification.data['author']['name'] }}</small>
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['notifications', 'for_user'],

        mounted() {
            var self = this;
            var pusher = new Pusher(pusher_key, {cluster: pusher_cluster});
            var channel = pusher.subscribe('user_id' + this.for_user.id);

            channel.bind('NotifyAboutProject', function(data)
                {
                    jQuery( document ).ready(function($) {
                        $('#slide-out').append('<li class="ui feed notification-item"><a href="' + data.link + '"><i class="material-icons ' + data.color_icon + '">' + data.icon + '</i><span>' +  data.project.title + '</span> <img class="responsive-img circle" style="width: 25px; position: relative; top: 10px;" src="/uploads/avatars/' + data.author.image + '"> <small>' + data.author.name + '</small></a></li>');

                    });
                }
            );

        },


        methods: {
            hasUnreadNotifications()
            {
                if (_.size(this.notifications) > 0) {
                    return _.size(
                        _.filter(this.notifications, notification => {
                            return !notification.read
                        })
                    )
                }

                return 0;
            },
            countUnreadNotifications()
            {
                if (_.size(this.notifications) > 0) {
                    return toNumber(this.notifications.length)
                }

                return 0;
            },
        }
    }
</script>
