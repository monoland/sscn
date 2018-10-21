@extends('base')

@section('apps')
    <v-navigation-drawer class="grey lighten-4" width="240" fixed clipped app>
        <v-list>
            <v-list-tile class="{{ $page === 'dashboard' ? 'v-list__tile--active' : ''}}" href="/dashboard">
                <v-list-tile-action><v-icon>home</v-icon></v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Dashboard</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-divider></v-divider>
            <v-subheader>Master</v-subheader>

            <v-list-tile class="{{ $page === 'recaps' ? 'v-list__tile--active' : ''}}" href="/recaps">
                <v-list-tile-action><v-icon>assignment</v-icon></v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Rekapan Pendaftaran</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile class="{{ $page === 'register' ? 'v-list__tile--active' : ''}}" href="/register">
                <v-list-tile-action><v-icon>assignment_ind</v-icon></v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Data Pendaftaran</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile class="{{ $page === 'fail' ? 'v-list__tile--active' : ''}}" href="/fail">
                <v-list-tile-action><v-icon>assignment_late</v-icon></v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Tidak Lolos Verifikasi</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile class="{{ $page === 'verify' ? 'v-list__tile--active' : ''}}" href="/verify">
                <v-list-tile-action><v-icon>assignment_turned_in</v-icon></v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Lolos Verifikasi</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-navigation-drawer>

    <v-toolbar color="white" height="56" flat fixed clipped-left app>
        <v-toolbar-side-icon></v-toolbar-side-icon>

        <v-toolbar-title>Product Name</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn color="grey--text" icon>
            <v-icon>notifications</v-icon>
        </v-btn>

        <v-menu v-model="$root.menu"
            :nudge-width="240"
            bottom left
        >
            <v-avatar size="32" slot="activator">
                <v-icon large>account_circle</v-icon>
            </v-avatar>

            <v-card class="v-card__account">
                <v-list class="pt-0">
                    <v-list-tile avatar>
                        <v-list-tile-avatar>
                            <v-icon large>account_circle</v-icon>
                        </v-list-tile-avatar>

                        <v-list-tile-content>
                            <v-list-tile-title>Sample</v-list-tile-title>
                            <v-list-tile-sub-title>sample@xxx.com</v-list-tile-sub-title>
                        </v-list-tile-content>
                    </v-list-tile>

                    <v-divider></v-divider>

                    <v-list-tile>
                        <v-list-tile-action><v-icon>settings</v-icon></v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Settings</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile @click="signOut">
                        <v-list-tile-action><v-icon>exit_to_app</v-icon></v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Sign out</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </v-list>
            </v-card>
        </v-menu>
    </v-toolbar>

    <v-content>
        @yield('page')
    </v-content>

    <v-snackbar 
        v-model="$root.message.show"
        :color="$root.message.type"
        :timeout="$root.message.time"
    >
        @{{ $root.message.text }}

        <v-btn dark flat @click="$root.message.show = false">close</v-btn>
    </v-snackbar>
@endsection