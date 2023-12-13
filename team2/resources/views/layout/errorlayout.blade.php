@forelse ($errors->all() as $val)
<div class="error">{{$val}}</div>
@empty

@endforelse