<template>
    <v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <form method="POST" action="/">
                    <input type="hidden" name="_token" ref="token">

                    <v-card width="450" class="v-card__authent">
                        <v-card-title>
                            <h3 class="headline">Sign in</h3>
                            <div class="describe">Enter your credential</div>
                        </v-card-title>

                        <v-card-text>
                            <v-text-field v-model="email"
                                label="Email address"
                                name="email"
                            ></v-text-field>

                            <v-text-field v-model="password"
                                label="Your password"
                                name="password"
                                :append-icon="showpass ? 'visibility_off' : 'visibility'"
                                :type="showpass ? 'text' : 'password'"
                                @click:append="showpass = !showpass"
                            ></v-text-field>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="primary" type="submit">Sign in</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>
            </v-layout>
        </v-container>
    </v-content>
</template>

<script>
export default {
    name: 'page-login',

    data:() => ({
        email: null,
        password: null,
        showpass: false
    }),

    mounted() {
        this.$refs.token.value = this.$token;
    }
};
</script>