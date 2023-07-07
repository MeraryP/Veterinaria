@extends('adminlte::page')
<div style="display:none">
<script src="{{ asset("JS/sweetalert2.all.min.js") }}"></script>
<script src="{{ asset("JS/app.js") }}"></script>
</div>


<style>
    .content-wrapper {
        background-color: #ffffff !important;
    }
    .wrapper, body, html {
        min-height: 0vh !important;
    }

    .layout-footer-fixed .wrapper .content-wrapper {
        padding-top: calc(3.5rem + 1px) !important;
        margin-top: 0px !important;
    }

    body {
        height: calc(100vh - 80px) !important;
    }


</style>




