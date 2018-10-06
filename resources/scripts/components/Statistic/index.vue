<template>
    <v-card :color="color" :flat="flat">
        <v-card-text class="normal-flex">
            <v-avatar color="teal">
                <v-icon dark>{{ icon }}</v-icon>
            </v-avatar>
            <div class="v-card__statistic">
                <div class="v-card__statistic--title">{{ title }}</div>
                <div class="v-card__statistic--value">{{ value }}</div>
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    name: 'm-statistic',

    props: {
        icon: {
            type: String,
            default: 'assignment'
        },

        color: {
            type: String,
            default: 'teal lighten-5'
        },

        flat: {
            type: Boolean,
            default: true
        },

        title: {
            type: String,
            default: 'UMUM'
        },

        value: {
            type: String,
            default: '0/0'
        }
    }
};
</script>

