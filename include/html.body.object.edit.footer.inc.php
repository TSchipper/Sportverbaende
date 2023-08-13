                    <div class="row">
                        <div class="btn-group" ID="actionButtons">
                            <button type="submit" name="command" value="update" class="btn btn-success">
                                <img class="listIcon" src="./icon/Save.png" title="Speichern">&nbsp;|&nbsp;Speichern
                            </button>
                            <button type="submit" name="command" value="discardUpdate" class="btn btn-secondary">
                                <img class="listIcon" src="./icon/Refresh.png" title="Verwerfen">&nbsp;|&nbsp;Verwerfen
                            </button>
                            <button type="button" ID="btnDelete" onClick="activateDeleteConfirmation ()"
                                class="btn btn-danger visible">
                                <img class="listIcon" src="./icon/Delete.png" title="Löschen">&nbsp;|&nbsp;Löschen
                            </button>
                        </div>
                        <div class="btn-group invisible" ID="confirmationButtons">
                            <button ID="confirmationText" type="button" class="btn btn-light">Soll dieses Objekt
                                gelöscht werden?</button>
                            <button ID="confirmationYes" type="submit" name="command" value="delete"
                                class="btn btn-danger">Ja</button>
                            <button ID="confirmationNo" type="button" class="btn btn-secondary"
                                onClick="deactivateDeleteConfirmation ()">Nein</button>
                        </div>
                    </div>