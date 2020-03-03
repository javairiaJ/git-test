<div class="checkbox icheck">
    <label>
    <input type="checkbox" name="terms" id="terms" required="required">
    I agree to the <a target="_blank" href="{{url('terms')}}" >terms</a>.
    </label>
</div>
<!--<script>
    function check_terms_services() {
        var terms = jQuery("#terms").prop("checked");

        if (terms == false) {
            $('.terms-errors').show();
            $('.terms-errors').text('Please accept our terms of service.');
            $('.terms-errors').addClass('alert alert-danger');

            return false;
        }

    }
</script>-->