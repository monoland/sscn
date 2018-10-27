@extends('base')

@section('apps')
<v-toolbar color="white" height="72" flat fixed clipped-left app>
    <v-toolbar-title>
        <a href="/">SSCN</a>
    </v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items>
        <v-btn flat href="/jadwal">JADWAL UJIAN</v-btn>
    </v-toolbar-items>
</v-toolbar>

<v-content>
    <page-exam></page-exam>
</v-content>
@endsection