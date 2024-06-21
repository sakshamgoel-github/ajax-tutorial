<h1>Hello World</h1>
<select name="postId" id="postId" onchange="getComment(this.value)">
    <option value="">Select Post id</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select>
<select name="commentId" id="commentId" onchange="getEmail(this.value)">
    <option value="">Select Comment Id</option>
</select>
<input type="text" readonly id="email">

<!-- Loader Element -->
<div id="loader" style="display: none;">Loading...</div>

<script>
    function toggleLoader(show) {
        const loader = document.getElementById('loader');
        loader.style.display = show ? 'block' : 'none';
    }

    function getComment(id) {
        if (id) {
            toggleLoader(true); // Show loader

            const commentSelect = $('#commentId')[0].selectize;
            commentSelect.clearOptions(); // Clear previous options

            jQuery.ajax({
                url: `comment?postId=${id}`,
                type: "GET",
                success: (res) => {
                    toggleLoader(false); // Hide loader

                    // Populate with new options
                    res.forEach(comment => {
                        commentSelect.addOption({value: comment.id, text: comment.id});
                    });
                },
                error: (err) => {
                    toggleLoader(false); // Hide loader
                    console.error('Error fetching comments:', err);
                }
            });
        } else {
            console.log('Please select a valid post ID.');
        }
    }

    function getEmail(id) {
        if (id) {
            toggleLoader(true); // Show loader
            jQuery.ajax({
                url: `email?commentId=${id}`,
                type: "GET",
                success: (res) => {
                    toggleLoader(false); // Hide loader
                    const inputEle = document.getElementById('email');
                    inputEle.value = res.email;
                },
                error: (err) => {
                    toggleLoader(false); // Hide loader
                    console.error("Error fetching email", err);
                }
            });
        } else {
            console.error("Please select a valid comment");
        }
    }

    $(document).ready(function() {
        $('#postId').selectize({
            sortField: 'text'
        });
        $('#commentId').selectize({
            sortField: 'text'
        });
    });
</script>
