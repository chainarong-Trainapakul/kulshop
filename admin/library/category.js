// JavaScript Document
function checkCategoryForm()
{
    with (window.document.frmCategory) {
		if (isEmpty(txtName, 'Enter category name')) {
			return;
		} else if (isEmpty(mtxDescription, 'Enter category description')) {
			return;
		} else {
			submit();
		}
	}
}

function addCategory(parentId)
{
	targetUrl = 'index.php?view=add';
	if (parentId != 0) {
		targetUrl += '&parentId=' + parentId;
	}
	
	window.location.href = targetUrl;
}

function modifyCategory(catId)
{
	window.location.href = 'index.php?view=modify&catId=' + catId;
}

function deleteCategory(catId)
{
	if (confirm('คุณต้องการลบใช่หรือไม่')) {
		window.location.href = 'processCategory.php?action=delete&catId=' + catId;
	}
}

function deleteImage(catId)
{
	if (confirm('คุณต้องการลบใช่หรือไม่?')) {
		window.location.href = 'processCategory.php?action=deleteImage&catId=' + catId;
	}
}