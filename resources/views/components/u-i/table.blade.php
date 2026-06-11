<div class="table-responsive">
    <table {{ $attributes->merge([
        'class' => 'table table-bordered table-hover'
    ]) }}>
        {{ $slot }}
    </table>
</div>