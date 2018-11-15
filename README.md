# Memory

## Story
User selects game size. The selected amount of cards are displayed with the back side up. User clicks on one card. The card flips and the picture is displayed. The user selects a second card. The second card flips and displays the picture. The pictures are compared - if same, they will be taken away. If they are not the same, they will flip over again. Once all matching cards have been found, the user has won. The attempts are counted and added to a high score list. Less attempts is better.  

## Classes/design
* Pile - a pile of cards will be generated. User can choose size of deck. Available sizes are 4x4, 5x5, and 6x6. 
* Card - a card has a specific id which matches the name of the picture of the card. 
* High score View - high score list should be displayed by the end of a round. User's score will be included in the list. 
* File reader - assists high score by writing and reading from the file that consists all scores
* Game View - displays cards in a shuffled pile with the back side up. 
* Game controller - decides whether or not a match is found and takes action.   

