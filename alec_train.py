from chatterbot import ChatBot
from chatterbot.trainers import ChatterBotCorpusTrainer
from chatterbot.response_selection import get_random_response
import os
import nltk

def setup():
    bot=ChatBot('Alec',
    storage_adapter='chatterbot.storage.SQLStorageAdapter',
    logic_adapters=[
        {
            'import_path':'chatterbot.logic.BestMatch',
            'default_response':'I am sorry, but I do not understand',
            'maximum_similarity_threshold':0.70,
            'response_selection_method':get_random_response
        }
    ],
    trainer='chatterbot.trainers.ChatterBotCorpusTrainer')
    trainer= ChatterBotCorpusTrainer(bot)
    data_path='C:/Git Projects/ALEC/Department/'
    for files in os.listdir(data_path):
        trainer.train(data_path+files)
		
setup()