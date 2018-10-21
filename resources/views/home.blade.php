@extends('base')

@section('apps')
<v-toolbar color="white" height="72" flat fixed clipped-left app>
    <v-toolbar-title>SSCN</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items>
        <v-btn flat>REKAPITULASI</v-btn>
        <v-btn flat>PELAMAR</v-btn>
    </v-toolbar-items>
</v-toolbar>

<v-content>
    <page-home></page-home>
</v-content>
@endsection