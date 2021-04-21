<td class="col-actions">
    <button type="button" class="btn btn-primary confirm-button" data-value="{{ route('admin.'.$thRouteActionKey.'.delete', ['id' => $gridItem->id]) }}" data-toggle="modal" data-target="#delete-confirm-dialog">
        <span class="btn-delete">Delete</span>
    </button>
</td>
