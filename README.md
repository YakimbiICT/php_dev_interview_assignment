# PHP interview assignment

## Description

Your task is to build a simple web-based image hosting service.
Users can fetch images metadata from an external service (flickr, google images, facebook etc, you choose),
server side or client side it's up to you, and can also set pictures as favorites.
Image metadata are fetched, not the image itself.
Favorite images can have a description.
Favorite images appear on the user's home page.
Users can also delete favourited images.
Users can also delete favourited image descriptions.

### You have to implement the following user stories:

* AS a user, I WANT TO fetch 20 random images data from the choosen external service.
  and see them on the homepage.
* AS a user, I WANT TO favorite an image. (ajax)
* AS a user, I WANT TO add a description to a favourite image. (ajax)
* AS a user, I WANT TO view favorite images.
* AS a user, I WANT TO delete favorite images.
* AS a user, I WANT TO delete favorite image descriptions.

**No user login required.**

You have high expecations from your web app and figure that it's best to provide an API for
developers/other services/mobile devices.
The API should allow the developer to do all of the above using calls to the API. You
can design and implement the API however you want. Of course, we'd also like to see an API client.


## Rules:

* Clone this repo to your github account.
* PHP 5.3 .
* You are not allowed to use any PHP framework. However, you are free to use any PHP library.
* You are free to use any Javascript library.
* You get huge bonus points for writing unit/functional tests.
* Provide a SQL file for creating the database.
* Provide a configuration file and instructions for how to run the app on our machines. An automaded scripts is a plus.
* You have to push the code on your Github account and make a pull request to YakimbiICT/php_dev_interview_assignment repo.
* Not required, but it would be great if you can host the app on the Internet so that we can play
  with it without having to install/configure it. ;-) 

**IF YOU CAN'T USE A PUBLIC REPO ON GITHUB, USE BITCUCKET [[ https://bitbucket.org/ ]] AND SET UP A PRIVATE REPO**


# Edward Halls, PHP interview assignment

## Intro/Abstract

When I initially approached this interview task, there was no set deadline. 
Hence, it was as fast as you can yet at a balanced pace as not to let too much quality suffer
as to have smooth revisions in the future. As you look through the code you will see 
where configs have been hardcoded and dynamic solutions/alternatives avoided in order 
to keep complexity from slowing progress.


## Design notes

I decided to go for a simple folder structure which neatly broke out
the controllers, models, and views. This way it makes it easier to understand
what files go where and what they should be doing for such a purpose. It also
easy to plug in Unit tests.

This sets the mind to think of the code in components or like lego pieces 
and allow libraries/frameworks to be located and accessed easily.

The design of the API is approached with the general concept of Multiple Input/Outputs.
It is WET as opposed to DRY to break out any API implementation into a seperate code base which simply
reimplements or mutates the controller in a awkard fashion.The sematics of the input/output data for any controller will be near identical, 
its fingerprint so to speak. 

Hence to reduce maintenance and lower cost per line you would abstract before and after the contoller/model 
as the only things that differ would be the format of your input and the desired output format.
Thus, for example: Unit/Functional tests will only cover one set of MVC entities, where
the view maintains multiple juxtaposed I/O renderers.

The browser renderer(HTML) is just a different format of data and should 
be thought of and treated as such. Usually people seem to think of APIs as a seperate
implementation or "realm". The reality is that HTTP+HTML is its default "API", its Data
Interchange Format and thus should be coupled to a gateway/abstraction handled at input/output
to the controllers to make it as DRY as possible.


## Development Notes

Its was my intention to build a robust system( goal is from scratch) ASAP.
With time being the opponent, I stored "extra" complexity in the cooler future improvement.

Issues:
-Unit/Functional testing needs more work but is a proof of concept through structure 
and method of how it could be applied to this structure.
-Error logging/handling is poorly handled, only certain key problems covered. No blanketing.
-Generally the code does not properly cover all problem cases/concerns as does a more mature
framework.
-Keep in mind, it was coded and debugged in 2 days and revised/extended for another 2. 
 It is not yet awesome but meets the requirements stipulated in a sensible fashion.
-It could use Form like validation constructs



