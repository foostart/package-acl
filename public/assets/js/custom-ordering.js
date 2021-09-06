"use strict";

/**
 * @requires admin_message_script
 * @param {JSON} messages
 * @param {JSON} spec
 * @returns {appender.that}
 */

var appender = function (spec, tb_orders) {

    // manage action in ordering
    var that = {};

    // contains the ordering filters
    var orderings = [];

    // the separator used for the hidden ordering fields
    var separator = ",";

    // id element sorting
    var ordering_select = $("#" + spec.ordering_select);
    var order_by_select = $("#" + spec.order_by_select);
    var ordering_fied = $("#" + spec.ordering_field);
    var order_by_field = $("#" + spec.order_by_field);
    var append_sorting_field = $("#" + spec.append_sorting);

    /**
     * Initialize action ordering filter
     * @returns {void}
     */
    that.initialize = function () {

        var order_by_tokens = order_by_field.val().split(separator);
        var ordering_tokens = ordering_fied.val().split(separator);

        // validation
        if (order_by_tokens.length != order_by_tokens.length) {
            return false;
        }

        // create orderings array
        for (var i = 0; i < order_by_tokens.length; i++) {
            if (order_by_tokens[i].length == 0 || ordering_tokens[i].length == 0) {
                continue;
            }

            orderings.push({
                "order_by": order_by_tokens[i],
                "ordering": ordering_tokens[i]
            });
        }

        // render fields
        for (i = 0; i < orderings.length; i++) {
            that.appendPlaceholder(i);
        }

    }//end initialize

    /**
     *
     * @returns {undefined}
     */
    that.addOrdering = function () {
        that.appendPlaceholder(that.appendOrdering());
    };

    /**
     * Add order field to disabled input
     * @param {type} index
     * @returns {undefined}
     */
    that.appendPlaceholder = function (index) {
        var order_by_placeholder = '<div class="col-md-6">' +
            '<input type="text" disabled="disabled" class="form-control" value="' + orderings[index].order_by + '">' +
            '</div>';
        var field_placeholder = '<div class="col-md-4" field="' + orderings[index].ordering + '">' +
            '<input type="text" disabled="disabled" class="form-control" value="' + orderings[index].ordering + '" >' +
            '</div>';
        var delete_ordering = '<div class="col-md-2">' +
            '<a onclick="myAppender.removeOrdering(' + index + ');" class="btn btn-default pull-right ' + spec.remove_ordering_button + '">\n\
                <i class="fa fa-minus"></i></a>' +
            '</div>';

        append_sorting_field.append('<div class="margin-top-10" id="ordering_' + index + '" ><div class="row">' +
            order_by_placeholder + field_placeholder + delete_ordering +
            '</div></div>');
    }

    /**
     * Remove selected ordering by index
     * @param {int} number
     * @returns {void}
     */
    that.removeOrdering = function (number) {
        that.clearErrorMessage();
        var ordering_fields = document.getElementById('ordering_' + number);
        ordering_fields.parentNode.removeChild(ordering_fields);

        //remove out of object by index
        orderings.splice(number, 1);
        //clear field orders
        append_sorting_field.html('');
        //render field orders
        for (var i = 0; i < orderings.length; i++) {
            that.appendPlaceholder(i);
        }
    }

    that.appendOrdering = function () {
        var ordering_value = ordering_select.val();
        var order_by_value = order_by_select.val();

        orderings.push({
            "ordering": ordering_value,
            "order_by": order_by_value
        });

        return (orderings.length - 1);
    }

    /**
     *
     * @returns {undefined}
     */
    that.fillOrderingInput = function () {

        var order_by_str;
        var ordering_str;

        for (var i = 0; i < orderings.length; i++) {
            if (i == 0) {
                order_by_str = orderings[i].order_by;
                ordering_str = orderings[i].ordering;
            } else {
                order_by_str += separator + orderings[i].order_by;
                ordering_str += separator + orderings[i].ordering;
            }
        }
        $("#" + spec.order_by_field).val(order_by_str);
        $("#" + spec.ordering_field).val(ordering_str);
    }

    /**
     * Check validate order: check NULL, check selected order
     * @returns {Boolean}
     */
    that.validate = function () {
        var order_by_value = order_by_select.val();

        that.clearErrorMessage();

        //Check empty selected sorting
        if (order_by_value == "") {
            that.setErrorMessage('required', spec.order_by_select);
            return false;
        } else {
            //Check existing selected sorting
            if (that.isSelectedOrdering(order_by_value)) {
                that.setErrorMessage('existing', spec.order_by_select);
                return false;
            }
        }
        return true;
    }

    /**
     * Return list of ordering
     * @returns {Array|appender.orderings}
     */
    that.getOrderings = function () {
        return orderings;
    };

    that.isSelectedOrdering = function (order_by) {
        var selected_orders = that.getOrderings();
        if (selected_orders === undefined) {
            return false;
        } else {
            for (var i = 0; i < selected_orders.length; i++) {
                if (selected_orders[i].order_by === order_by) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Clear error message
     * @returns {void}
     */
    that.clearErrorMessage = function () {
        $(".form-validable").removeClass('form-error');
        $(".form-error-required-order").addClass('hidden');
        $(".form-error-existing-order").addClass('hidden');
    }

    /**
     * Set error message
     * @param {string} error_type
     * @param {string} field_id
     * @returns {void}
     */
    that.setErrorMessage = function (error_type, field_id) {
        switch (error_type) {
            case 'required':
                $("#" + field_id).addClass('form-error');
                $(".form-error-required-order").removeClass('hidden');
                break;
            case 'existing':
                $("#" + field_id).addClass('form-error');
                $(".form-error-existing-order").removeClass('hidden');
                break;
            default:
                break;
        }
    }

    return that;
};

// appender constructor data
var spec = {
    order_by_field: "order-by",
    ordering_field: "ordering",
    order_by_select: "order-by-select",
    ordering_select: "ordering-select",
    append_sorting: "append-sorting",
    add_ordering_button: "add-ordering-filter",
    remove_ordering_button: "remove-ordering-button",
    search_submit_button: "search-submit",
    search_reset_button: "search-reset",
};

/**
 * List of column names
 */
var tb_orders = {
    order: 'tb-order',
    email: 'tb-email',
    first_name: 'tb-first_name',
    last_name: 'tb-last_name',
    active: 'tb-active',
    last_login: 'tb-last-login'
};

var myAppender = appender(spec, tb_orders);

$(document).ready(function () {
    myAppender.initialize();

    $("#" + spec.add_ordering_button).click(function () {
        if (!myAppender.validate()) {
            return false;
        }
        myAppender.addOrdering();
        return true;
    });

    $("#" + spec.search_submit_button).click(function (e) {
        myAppender.fillOrderingInput();
    });
});

