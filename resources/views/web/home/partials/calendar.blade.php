<div class="clndr-container" >
  <div id="clndr">
    <div id="full-clndr" class="clearfix">
      <script type="text/template" id="full-clndr-template">
        <div class="clndr-controls">
          <div class="clndr-btn clndr-previous-button"></div>
            <div class="clndr-month">
              <%= month %>
            </div>
            <div class="clndr-year">
              <%= year %>
            </div>
                <div class="clndr-btn clndr-next-button"></div>
            </div>
            <div class="clndr-grid">
                <div class="days-of-the-week">
                  <div class="header-days">
                    <% _.each(daysOfTheWeek, function(day) { %>
                        <div class="header-day"><%= day %></div>
                    <% }); %>
                </div>
                    <div class="days">
                    <% _.each(days, function(day) { %>
                        <div class="<%= day.classes %>"><%= day.day %></div>
                    <% }); %>
                    </div>
                </div>
            </div>
        </script>
    </div>
  </div>
</div>
