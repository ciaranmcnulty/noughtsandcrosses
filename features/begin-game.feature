Feature: Creating a game
  In order to play with my friends
  As a player
  I should be able to create a new game

  @critical
  Scenario: Beginning a game
    When I begin a game
    Then the game should have begun