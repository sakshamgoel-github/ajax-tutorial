<h1>Hello World</h1>
<select name="itemId" id="itemId" onchange="getSrv(this.value)">
    <option value="">Select Item id</option>
    <option value="100">Item 1</option>
    <option value="200">Item 2</option>
    <option value="300">Item 3</option>
    <option value="400">Item 4</option>
</select>
<select name="srvId" id="srvId" onchange="getQuantity(this.value)">
    <option value="">Select Srv</option>
</select>
<input type="text" readonly id="quantity">

<!-- Loader Element -->
<div id="loader" style="display: none;">Loading...</div>

<script>
    function toggleLoader(show) {
        const loader = document.getElementById('loader');
        loader.style.display = show ? 'block' : 'none';
    }

    function getSrv(id) {
        if (id) {
            const srvSelect = $('#srvId')[0].selectize;
            srvSelect.clearOptions(); // Clear previous options
            toggleLoader(true); // Show loader
            jQuery.ajax({
                url: `srv?itemId=${id}`,
                type: "GET",
                success: (res) => {
                    toggleLoader(false); // Hide loader

                    // Populate with new options
                    res.forEach(srv => {
                        srvSelect.addOption({value: srv.id, text: srv.id});
                    });
                },
                error: (err) => {
                    toggleLoader(false); // Hide loader
                    console.error('Error fetching srv:', err);
                }
            });
        } else {
            console.log('Please select a valid item ID.');
        }
    }

    function getQuantity(srvId) {
        const itemId = document.getElementById('itemId').value;
        if (srvId && itemId) {
            toggleLoader(true); // Show loader
            jQuery.ajax({
                url: `quantity?srvId=${srvId}&itemId=${itemId}`,
                type: "GET",
                success: (res) => {
                    toggleLoader(false); // Hide loader
                    const inputEle = document.getElementById('quantity');
                    if (res && res.quantity !== undefined) {
                        inputEle.value = res.quantity;
                    } else {
                        location.reload();
                    }
                },
                error: (err) => {
                    toggleLoader(false); // Hide loader
                    console.error("Error fetching quantity", err);
                }
            });
        } else {
            console.error("Please select both item and srv.");
        }
    }

    $(document).ready(function() {
        $('#itemId').selectize({
            sortField: 'text'
        });
        $('#srvId').selectize({
            sortField: 'text'
        });
    });
</script>
