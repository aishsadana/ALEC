from chatterbot import ChatBot
from chatterbot.trainers import ChatterBotCorpusTrainer
from chatterbot.response_selection import get_random_response
import os

def setup():
    bot=ChatBot('Alec',
    storage_adapter='chatterbot.storage.SQLStorageAdapter',
    response_selection_method='chatterbot.response_selection.get_random_response',
    trainer='chatterbot.trainers.ChatterBotCorpusTrainer')
    trainer= ChatterBotCorpusTrainer(bot)
    data_path='C:/Git Projects/ALEC/Department/'
    for files in os.listdir(data_path):
        trainer.train(data_path+files)
		
setup()