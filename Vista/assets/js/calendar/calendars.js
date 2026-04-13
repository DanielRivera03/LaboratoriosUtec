'use strict';

/* eslint-disable require-jsdoc, no-unused-vars */

var CalendarList = [];

function CalendarInfo() {
    this.id = null;
    this.name = null;
    this.checked = true;
    this.color = null;
    this.bgColor = null;
    this.borderColor = null;
    this.dragBgColor = null;
}

function addCalendar(calendar) {
    CalendarList.push(calendar);
}

function findCalendar(id) {
    var found;

    CalendarList.forEach(function(calendar) {
        if (calendar.id === id) {
            found = calendar;
        }
    });

    return found || CalendarList[0];
}

function hexToRGBA(hex) {
    var radix = 16;
    var r = parseInt(hex.slice(1, 3), radix),
        g = parseInt(hex.slice(3, 5), radix),
        b = parseInt(hex.slice(5, 7), radix),
        a = parseInt(hex.slice(7, 9), radix) / 255 || 1;
    var rgba = 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')';

    return rgba;
}

(function() {
    var calendar;
    var id = 0;

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab1';
    calendar.color = '#ffffff';
    calendar.bgColor = '#e00000';
    calendar.dragBgColor = '#e00000';
    calendar.borderColor = '#e00000';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab2';
    calendar.color = '#ffffff';
    calendar.bgColor = '#f19898';
    calendar.dragBgColor = '#f19898';
    calendar.borderColor = '#f19898';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab3';
    calendar.color = '#ffffff';
    calendar.bgColor = '#f971ce';
    calendar.dragBgColor = '#f971ce';
    calendar.borderColor = '#f971ce';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab4';
    calendar.color = '#ffffff';
    calendar.bgColor = '#f312d5';
    calendar.dragBgColor = '#f312d5';
    calendar.borderColor = '#f312d5';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab5';
    calendar.color = '#ffffff';
    calendar.bgColor = '#9e62c6';
    calendar.dragBgColor = '#9e62c6';
    calendar.borderColor = '#9e62c6';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab6';
    calendar.color = '#ffffff';
    calendar.bgColor = '#6b099f';
    calendar.dragBgColor = '#6b099f';
    calendar.borderColor = '#6b099f';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab7';
    calendar.color = '#ffffff';
    calendar.bgColor = '#705d92';
    calendar.dragBgColor = '#705d92';
    calendar.borderColor = '#705d92';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab8';
    calendar.color = '#ffffff';
    calendar.bgColor = '#3a19e1';
    calendar.dragBgColor = '#3a19e1';
    calendar.borderColor = '#3a19e1';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab9';
    calendar.color = '#ffffff';
    calendar.bgColor = '#4d6fd5';
    calendar.dragBgColor = '#4d6fd5';
    calendar.borderColor = '#4d6fd5';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab10';
    calendar.color = '#ffffff';
    calendar.bgColor = '#42b0f5';
    calendar.dragBgColor = '#42b0f5';
    calendar.borderColor = '#42b0f5';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab11';
    calendar.color = '#ffffff';
    calendar.bgColor = '#61e5ff';
    calendar.dragBgColor = '#61e5ff';
    calendar.borderColor = '#61e5ff';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab12';
    calendar.color = '#ffffff';
    calendar.bgColor = '#a6f2cf';
    calendar.dragBgColor = '#a6f2cf';
    calendar.borderColor = '#a6f2cf';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab13';
    calendar.color = '#ffffff';
    calendar.bgColor = '#4fab61';
    calendar.dragBgColor = '#4fab61';
    calendar.borderColor = '#4fab61';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab14';
    calendar.color = '#ffffff';
    calendar.bgColor = '#54a800';
    calendar.dragBgColor = '#54a800';
    calendar.borderColor = '#54a800';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Lab15';
    calendar.color = '#ffffff';
    calendar.bgColor = '#fff700';
    calendar.dragBgColor = '#fff700';
    calendar.borderColor = '#fff700';
    addCalendar(calendar);

    
})();