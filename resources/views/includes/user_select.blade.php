    <div class='vertical_offset_m'><strong>Select Participants:</strong></div>
    @foreach ( $users as $key => $user )
        <div class='vertical_offset_s indent_offset_l'>{{ Form::checkbox('debtor', $user->id, true, ['id' => $user->last_name]) }} <label for='{{ $user->last_name }}'> {{ $user->first_name }} </label></div>
    @endforeach
