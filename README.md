# Assist
This is a site created using server-side programming.

## The theme of the site and the logic of work
Assist is a site for ordering various services for creating films and videos. On the main page, the user sees a landing page from which he can go to the list of all services. There he sees the names and descriptions of all the services that the various studios provide. Information about these studios can be seen on a separate page. All descriptions, addresses and lists of employees will be displayed there. If the user wants to order one of the studio's services, then the site will first offer to log in, which can also be done by going to the "authorization" page. On it, a person logs into his account or creates a new one, indicating his contact information. After a successful login, the order is available. The menu item "my orders" also appears. The page with the order displays basic information about the service and the client, as well as the deadline by which the work will be completed. The term differs for each service and is compiled taking into account the weekend. The user leaves his comment on the order and sends it to the site. After that, on the page with orders, the user can track the status of the order.

If an employee of the studio visits the site, then the "management" menu item appears, where the work of the studio takes place.
If an ordinary employee enters the page, then only the "Work on orders" item will be available to him in the window. There you can change the current status of all received orders. If the head of the studio comes in, "Studio Management" and "Service Editing" become open. He can change information about the services and the studio, add new employees, change their positions and exclude them from the studio. If the administrator is logged in - the person who owns the entire site - then the item "Administration of studios" appears. The creation of new studios is available there, as well as the change of leaders.

MySql database was designed to create the site.

<img src="https://github.com/itwasjoke/Assist/blob/main/img/db.png?raw=true">

Of the development features, one can note the writing of a separate file in PHP, where all sorts of useful functions that I used in the process of work were registered. They have simplified the job of creating a website.
The site was transferred to the hosting along with the database. The link to the site will be in the description.
