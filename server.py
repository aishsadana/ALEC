from SimpleWebSocketServer import SimpleWebSocketServer, WebSocket
from alec import get_response
import nltk

class ChatServer(WebSocket):

    def handleMessage(self):
        # echo message back to client
        message = self.data
        response = get_response(message)
        self.sendMessage(response)

    def handleConnected(self):
        print(self.address, 'connected')

    def handleClose(self):
        print(self.address, 'closed')



server = SimpleWebSocketServer('', 8080, ChatServer)
server.serveforever()