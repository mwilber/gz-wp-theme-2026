(function ($) {
  if (typeof inlineEditPost === 'undefined') {
    return;
  }

  const originalEdit = inlineEditPost.edit;

  inlineEditPost.edit = function (id) {
    originalEdit.apply(this, arguments);

    const postId = typeof id === 'object' ? this.getId(id) : id;
    if (!postId) {
      return;
    }

    const $row = $('#post-' + postId);
    const projectId = $row.find('.greenzeta-project-col').data('projectId');
    const $editRow = $('#edit-' + postId);

    $editRow.find('select[name="greenzeta_project_id_quick"]').val(
      projectId ? projectId : ''
    );
  };
})(jQuery);
