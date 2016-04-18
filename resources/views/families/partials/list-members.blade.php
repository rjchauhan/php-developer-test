@foreach($members as $children)
    <ul>
        @if($children->id == $member->id)
            <li><strong>{{ $children->name }}</strong></li>
        @else
            <li>{{ $children->name }}</li>
        @endif

        @if(count($children->children_recursive))
            @include('families.partials.list-members', ['members' => $children->children_recursive])
        @endif
    </ul>
@endforeach