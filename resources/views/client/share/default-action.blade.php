<a class="btn-action js-btn-update-action text-info" href="{{$editUrl}}">
    <i class="fa fa-spinner fa-spin hidden"></i>
    <i class="fa fa-pencil main-icon-btn"></i>
</a>
<span class="btn-action js-btn-delete-action text-danger" title="Bạn có đồng ý xoá bản ghi này không?" @foreach($deleteAttributes ?? [] as $attributeName => $attributeValue) {{ "$attributeName = $attributeValue " }} @endforeach>
    <i class="fa fa-spinner fa-spin hidden"></i>
    <i class="fa fa-trash main-icon-btn"></i>
</span>
